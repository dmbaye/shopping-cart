<?php

$app->get('/', ['App\Controllers\HomeController', 'index'])->setName('home');
$app->get('/products/{slug}', ['App\Controllers\HomeController', 'show'])->setName('products.show');

$app->get('/cart', ['App\Controllers\CartController', 'index'])->setName('cart.index');
$app->get('/cart/add/{slug}/{quantity}', ['App\Controllers\CartController', 'store'])->setName('cart.store');
$app->post('/cart/add/{slug}', ['App\Controllers\CartController', 'update'])->setName('cart.update');

$app->get('/orders', ['App\Controllers\OrderController', 'index'])->setName('orders.index');
$app->get('/orders/{hash}', ['App\Controllers\OrderController', 'show'])->setName('orders.show');
$app->post('/orders/store', ['App\Controllers\OrderController', 'store'])->setName('orders.store');

$app->get('/braintree/token', ['App\Controllers\BraintreeController', 'token'])->setName('braintree.token');
