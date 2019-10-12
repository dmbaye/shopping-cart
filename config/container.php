<?php

use Psr\Container\ContainerInterface;
use function DI\get;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;
use Slim\Flash\Messages as Flash;
use App\Models\Product;
use App\Support\Storage\Contracts\StorageInterface;
use App\Support\Storage\SessionStorage;
use App\Basket\Basket;
use App\Validation\Contracts\ValidationInterface;
use App\Validation\Validator;
use App\Auth\Auth;

return [
    Twig::class => function (ContainerInterface $c) {
        $view = new Twig(__DIR__ . '/../resources/views', []);

        $view->addExtension(new TwigExtension(
            $c->get('router'),
            $c->get('request')->getUri()
        ));

        $view->getEnvironment()->addGlobal('basket', $c->get(Basket::class));
        $view->getEnvironment()->addGlobal('flash', $c->get(Flash::class));
        $view->getEnvironment()->addGlobal('auth', $c->get(Auth::class));

        return $view;
    },
    Flash::class => function (ContainerInterface $c) {
        return new Flash;
    },
    Product::class => function (ContainerInterface $c) {
        return new Product;
    },
    StorageInterface::class => function (ContainerInterface $c) {
        return new SessionStorage('cart');
    },
    Basket::class => function (ContainerInterface $c) {
        return new Basket(
            $c->get(SessionStorage::class),
            $c->get(Product::class
        ));
    },
    ValidationInterface::class => function (ContainerInterface $c) {
        return new Validator;
    },
    Auth::class => function (ContainerInterface $c) {
        return new Auth;
    }
];
