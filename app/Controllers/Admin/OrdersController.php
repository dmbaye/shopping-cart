<?php

namespace App\Controllers\Admin;

use App\Models\Order;
use App\Controllers\Controller;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class OrdersController extends Controller
{
    public function index(Request $request, Response $response)
    {
        $orders = Order::latest()->get();

        return $this->view->render($response, 'admin/orders/index.twig', compact('orders'));
    }

    public function show(Request $request, Response $response, int $id)
    {
        $order = Order::findOrFail($id);

        return $this->view->render($response, 'admin/orders/show.twig', compact('order'));
    }

    public function update(Request $request, Response $response, int $id)
    {

    }

    public function destroy(Request $request, Response $response, int $id)
    {}
}
