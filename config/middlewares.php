<?php

/*
|------------------------------------------------------------------------------
| Global Middlewares
|------------------------------------------------------------------------------
*/

$app->add(new App\Middlewares\ValidationErrorsMiddleware(
    $container->get(Slim\Router::class),
    $container->get(Slim\Views\Twig::class)
));

$app->add(new App\Middlewares\OldInputMiddleware(
    $container->get(Slim\Router::class),
    $container->get(Slim\Views\Twig::class)
));

/*
|------------------------------------------------------------------------------
| Route Middlewares
|------------------------------------------------------------------------------
*/

$auth = new App\Middlewares\AuthMiddleware(
    $container->get(Slim\Router::class),
    $container->get(Slim\Views\Twig::class)
);

$guest = new App\Middlewares\GuestMiddleware(
    $container->get(Slim\Router::class),
    $container->get(Slim\Views\Twig::class)
);

$admin = new App\Middlewares\AdminMiddleware(
    $container->get(Slim\Router::class),
    $container->get(Slim\Views\Twig::class)
);

return [
    'auth' => new App\Middlewares\AuthMiddleware(
        $container->get(Slim\Router::class),
        $container->get(Slim\Views\Twig::class)
    ),

    'guest' => new App\Middlewares\GuestMiddleware(
        $container->get(Slim\Router::class),
        $container->get(Slim\Views\Twig::class)
    ),

    'admin' => new App\Middlewares\AdminMiddleware(
        $container->get(Slim\Router::class),
        $container->get(Slim\Views\Twig::class)
    ),
];

