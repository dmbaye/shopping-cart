<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class AdminController extends Controller
{
    public function index(Request $request, Response $response)
    {
        return $this->view->render($response, 'admin/index.twig');
    }
}
