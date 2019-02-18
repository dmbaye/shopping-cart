<?php

namespace App\Controllers;

use Slim\Router;
use Slim\Views\Twig as View;
use Slim\Flash\Messages as Flash;
use App\Validation\Validator;
use App\Basket\Basket;

class Controller
{
    protected $router;

    protected $flash;

    protected $view;

    protected $basket;

    protected $validator;

    public function __construct(
        Router $router,
        Flash $flash,
        View $view,
        Basket $basket,
        Validator $validator
    ) {
        $this->router = $router;
        $this->flash = $flash;
        $this->view = $view;
        $this->basket = $basket;
        $this->validator = $validator;
    }
}
