<?php

$app->get('/', ['App\Controllers\HomeController', 'index'])->setName('home');
$app->get('/products/{slug}', ['App\Controllers\HomeController', 'show'])->setName('products.show');

$app->get('/cart', ['App\Controllers\CartController', 'index'])->setName('cart.index');
$app->get('/cart/add/{slug}/{quantity}', ['App\Controllers\CartController', 'store'])->setName('cart.store');
$app->post('/cart/add/{slug}', ['App\Controllers\CartController', 'update'])->setName('cart.update');

$app->get('/orders', ['App\Controllers\OrderController', 'index'])->setName('orders.index');
$app->get('/orders/{hash}', ['App\Controllers\OrderController', 'show'])->setName('orders.show');
$app->post('/orders/store', ['App\Controllers\OrderController', 'store'])->setName('orders.store');

$app->get('/register', ['App\Controllers\Auth\RegisterController', 'showRegister'])->setName('auth.register');
$app->get('/login', ['App\Controllers\Auth\LoginController', 'showLogin'])->setName('auth.login');
$app->get('/logout', ['App\Controllers\Auth\LoginController', 'logout'])->setName('auth.logout');
$app->post('/register', ['App\Controllers\Auth\RegisterController', 'register'])->setName('auth.register');
$app->post('/login', ['App\Controllers\Auth\LoginController', 'login'])->setName('auth.login');

$app->group('', function () {
    $this->get('/admin', ['App\Controllers\Admin\AdminController', 'index'])->setName('admin.index');
});

$app->get('/braintree/token', ['App\Controllers\BraintreeController', 'token'])->setName('braintree.token');
