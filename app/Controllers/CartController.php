<?php

namespace App\Controllers;

use App\Models\Product;
use App\Basket\Exceptions\QuantityExceededException;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class CartController extends Controller
{
    public function index(Request $request, Response $response)
    {
        $this->basket->refresh();

        return $this->view->render($response, 'cart/index.twig');
    }

    public function store(Request $request, Response $response, string $slug, int $quantity)
    {
        $product = Product::where('slug', $slug)->first();

        if (!$product) {
            return $response->withRedirect($this->router->pathFor('home'));
        }

        try {
            $this->basket->add($product, $quantity);
        } catch (QuantityExceededException $e) {
            //
            return $response->withRedirect($this->router->pathFor('cart.index'));
        }

        return $response->withRedirect($this->router->pathFor('cart.index'));
    }

    public function update(Request $request, Response $response, string $slug)
    {
        $product = Product::where('slug', $slug)->first();

        if (!$product) {
            return $response->withRedirect($this->router->pathFor('home'));
        }

        try {
            $this->basket->update($product, $request->getParam('quantity'));
        } catch (QuantityExceededException $e) {
            //
            return $response->withRedirect($this->router->pathFor('cart.index'));
        }

        return $response->withRedirect($this->router->pathFor('cart.index'));
    }
}
