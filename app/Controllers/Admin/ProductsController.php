<?php

namespace App\Controllers\Admin;

use App\Models\Product;
use App\Validation\Forms\ProductForm;
use App\Controllers\Controller;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class ProductsController extends Controller
{
    public function index(Request $request, Response $response)
    {
        $products = Product::latest()->get();

        return $this->view->render($response, 'admin/products/index.twig', compact('products'));
    }

    public function create(Request $request, Response $response)
    {
        return $this->view->render($response, 'admin/products/create.twig');
    }

    public function store(Request $request, Response $response)
    {
        $validation = $this->validator->validate($request, ProductForm::rules());

        if ($validation->fails()) {
            $this->flash->addMessage('error', 'Please enter valid data.');
            return $response->withRedirect($this->router->pathFor('products.create'));
        }

        $product = new Product();
        $product->name = $request->getParam('name');
        $product->slug = $request->getParam('slug');
        $product->description = $request->getParam('description');
        $product->price = $request->getParam('price');
        $product->stock = $request->getParam('stock');

        if (!$product->save()) {
            $this->flash->addMessage('error', 'Please enter valid data.');
            return $response->withRedirect($this->router->pathFor('products.create'));
        }

        $this->flash->addMessage('success', 'Your product was saved successfully.');
        return $response->withRedirect($this->router->pathFor('admin.products.index'));
    }

    public function show(Request $request, Response $repsonse, string $slug)
    {
        $product = Product::where('slug', $slug)->first();

        if (!$product) {
            return $response->withRedirect($this->route->pathFor('home'));
        }

        return $this->view->render($response, 'admin/products/show.twig', compact('product'));
    }

    public function edit(Request $request, Response $response, string $slug)
    {
        $product = Product::where('slug', $slug)->first();

        if (!$product) {
            return $response->withRedirect($this->route->pathFor('products.index'));
        }

        return $this->view->render($response, 'admin/products/edit.twig', compact('product'));
    }

    public function update(Request $request, Response $response, string $slug)
    {
        $validation = $this->validator->validate($request, ProductForm::rules());

        if ($validation->fails()) {
            $this->flash->addMessage('error', 'Please enter valid data.');
            return $response->withRedirect($this->router->pathFor('products.create'));
        }

        $product = Product::where('slug', $slug)->first();

        $product->name = $request->getParam('name');
        $product->slug = $request->getParam('slug');
        $product->description = $request->getParam('description');
        $product->price = $request->getParam('price');
        $product->stock = $request->getParam('stock');

        if (!$product->save()) {
            $this->flash->addMessage('error', 'Please enter valid data.');
            return $response->withRedirect($this->router->pathFor('products.create'));
        }

        $this->flash->addMessage('success', 'Your product was saved successfully.');
        return $response->withRedirect($this->router->pathFor('products.index'));
    }

    public function destroy(Request $request, Response $response, string $slug)
    {}
}
