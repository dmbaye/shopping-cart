<?php

/*
|------------------------------------------------------------------------------
| Routes
|------------------------------------------------------------------------------
*/

$app->get('/', ['App\Controllers\HomeController', 'index'])
    ->setName('home');
$app->get('/products/{slug}', ['App\Controllers\HomeController', 'show'])
    ->setName('products.show');

$app->get('/cart', ['App\Controllers\CartController', 'index'])
    ->setName('cart.index');
$app->get('/cart/add/{slug}/{quantity}', ['App\Controllers\CartController', 'store'])
    ->setName('cart.store');
$app->post('/cart/add/{slug}', ['App\Controllers\CartController', 'update'])
    ->setName('cart.update');

$app->get('/orders', ['App\Controllers\OrderController', 'index'])
    ->setName('orders.index');
$app->get('/orders/{hash}', ['App\Controllers\OrderController', 'show'])
    ->setName('orders.show');
$app->post('/orders/store', ['App\Controllers\OrderController', 'store'])
    ->setName('orders.store')
    ->add($auth);

$app->get('/register', ['App\Controllers\Auth\RegisterController', 'showRegister'])
    ->setName('auth.register')
    ->add($guest);
$app->get('/login', ['App\Controllers\Auth\LoginController', 'showLogin'])
    ->setName('auth.login')
    ->add($guest);
$app->get('/logout', ['App\Controllers\Auth\LoginController', 'logout'])
    ->setName('auth.logout')
    ->add($auth);;
$app->post('/register', ['App\Controllers\Auth\RegisterController', 'register'])
    ->setName('auth.register')
    ->add($guest);
$app->post('/login', ['App\Controllers\Auth\LoginController', 'login'])
    ->setName('auth.login')
    ->add($guest);

$app->group('/admin', function (App\App $app) {
    $app->get('', ['App\Controllers\Admin\AdminController', 'index'])
        ->setName('admin.index');

    $app->get('/products', ['App\Controllers\Admin\ProductsController', 'index'])
        ->setName('admin.products.index');
    $app->get('/products/create', ['App\Controllers\Admin\ProductsController', 'create'])
        ->setName('products.create');
    $app->get('/products/{slug}/edit', ['App\Controllers\Admin\ProductsController', 'edit'])
        ->setName('products.edit');
    $app->post('/products/store', ['App\Controllers\Admin\ProductsController', 'store'])
        ->setName('products.store');
    $app->post('/products/{slug}/update', ['App\Controllers\Admin\ProductsController', 'update'])
        ->setName('products.update');

    $app->get('/orders', ['App\Controllers\Admin\OrdersController', 'index'])
        ->setName('admin.orders.index');
    $app->get('/orders/{id}/show', ['App\Controllers\Admin\OrdersController', 'show'])
        ->setName('admin.orders.show');
    $app->get('/orders/{id}/delete', ['App\Controllers\Admin\OrdersController', 'delete'])
        ->setName('admin.orders.delete');
    $app->post('/orders/{id}/update', ['App\Controllers\Admin\OrdersController', 'update'])
        ->setName('admin.orders.update');
})->add($auth)->add($admin);

$app->get('/braintree/token', ['App\Controllers\BraintreeController', 'token'])
    ->setName('braintree.token');
