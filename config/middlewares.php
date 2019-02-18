<?php

$app->add(new App\Middlewares\ValidationErrorsMiddleware(
    $container->get(Slim\Router::class),
    $container->get(Slim\Views\Twig::class)
));

$app->add(new App\Middlewares\OldInputMiddleware(
    $container->get(Slim\Router::class),
    $container->get(Slim\Views\Twig::class)
));
