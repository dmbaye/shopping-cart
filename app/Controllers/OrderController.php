<?php

namespace App\Controllers;

use App\Models\Product;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Address;
use App\Auth\Auth;
use App\Validation\Forms\OrderForm;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class OrderController extends Controller
{
    /**
     * Undocumented function
     *
     * @param Request $request
     * @param Response $response
     * @return void
     */
    public function index(Request $request, Response $response)
    {
        $this->basket->refresh();

        if (!$this->basket->subTotal()) {
            $this->flash->addMessage('error', 'Your cart is empty.');
            return $response->withRedirect($this->router->pathFor('cart.index'));
        }

        return $this->view->render($response, 'orders/index.html.twig');
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @param Response $response
     * @return void
     */
    public function store(Request $request, Response $response)
    {
        $gateway = new \Braintree_Gateway([
            'environment' => env('BRAINTREE_ENVIRONMENT'),
            'merchantId' => env('BRAINTREE_MERCHANT_ID'),
            'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
            'privateKey' => env('BRAINTREE_PRIVATE_KEY'),
        ]);

        $this->basket->refresh();

        if (!$this->basket->subTotal()) {
            $this->flash->addMessage('error', 'Your cart is empty.');
            return $response->withRedirect($this->router->pathFor('cart.index'));
        }

        if (!$request->getParam('payment_method_nonce')) {
            $this->flash->addMessage('error', 'Please enter payment details.');
            return $response->withRedirect($this->router->pathFor('orders.index'));
        }

        // Validate inputs
        $validation = $this->validator->validate($request, OrderForm::rules());

        if ($validation->fails()) {
            $this->flash->addMessage('error', 'Please enter valid data.');
            return $response->withRedirect($this->router->pathFor('orders.index'));
        }

        $hash = bin2hex(random_bytes(32));

        $address = Address::firstOrCreate([
            'address1' => $request->getParam('address1'),
            'address2' => $request->getParam('address2'),
            'city' => $request->getParam('city'),
            'postal_code' => $request->getParam('postal_code'),
        ]);

        $user = Auth::user();

        $order = $user->orders()->create([
            'hash' => $hash,
            'paid' => false,
            'address_id' => $address->id,
            'total' => $this->basket->subTotal() + 5,
        ]);

        $allItems = $this->basket->all();

        $order->products()->saveMany(
            $allItems,
            $this->getQuantities($allItems)
        );

        $result = $gateway->transaction()->sale([
            'amount' => $this->basket->subTotal() + 5,
            'paymentMethodNonce' => $request->getParam('payment_method_nonce'),
            'options' => [
                'submitForSettlement' => true,
            ],
        ]);

        $event = new \App\Events\OrderWasCreated($order, $this->basket);

        if (!$result->success) {
            $event->attach([
                new \App\Handlers\RecordFailedPayment,
            ]);
            $event->dispatch();

            $this->flash->addMessage('error', 'Your payment failed. Try again later.');
            return $response->withRedirect($this->router->pathFor('orders.index'));
        }

        $event->attach([
            new \App\Handlers\MarkOrderPaid,
            new \App\Handlers\RecordSuccessfulPayment($result->transaction->id),
            new \App\Handlers\UpdateStock,
            new \App\Handlers\EmptyBasket,
        ]);

        $event->dispatch();

        $this->flash->addMessage('success', 'Thank your for your purchase.');
        return $response->withRedirect($this->router->pathFor('orders.show', ['hash' => $order->hash]));
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @param Response $response
     * @param string $hash
     * @return void
     */
    public function show(Request $request, Response $response, string $hash)
    {
        $order = Order::with('address', 'products')
            ->where('hash', $hash)
            ->first();

        if (!$order) {
            return $response->withRedirect($this->router->pathFor('home'));
        }

        return $this->view->render($response, 'orders/show.html.twig', compact('order'));
    }

    /**
     * Undocumented function
     *
     * @param array $items
     * @return void
     */
    private function getQuantities(array $items)
    {
        $quantities = [];

        foreach ($items as $item) {
            $quantities[] = ['quantity' => $item->quantity];
        }

        return $quantities;
    }
}
