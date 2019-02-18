<?php

namespace App\Controllers;

use App\Models\Product;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Basket\Basket;

class HomeController extends Controller
{
    /**
     * Home page
     * @param  Request  $request  [description]
     * @param  Response $response [description]
     *
     * @return Slim\Views\Twig    Page to show
     */
    public function index(Request $request, Response $response)
    {
        $products = Product::all();

        return $this->view->render($response, 'index.twig', compact('products'));
    }

    /**
     * Show product details
     * @param  Request  $request  [description]
     * @param  Response $response [description]
     * @param  int      $id       The id of the selected product
     *
     * @return View              [description]
     */
    public function show(Request $request, Response $response, string $slug)
    {
        $product = Product::where('slug', $slug)->first();

        if (!$product) {
            return $response->withRedirect($this->router->pathFor('home'));
        }

        return $this->view->render($response, 'show.twig', compact('product'));
    }
}
