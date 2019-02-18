<?php

namespace App\Middlewares;

use Slim\Router;
use Slim\Views\Twig as View;

class Middleware
{
    protected $router;

    protected $view;

    public function __construct(Router $router, View $view)
    {
        $this->router = $router;
        $this->view = $view;
    }
}
