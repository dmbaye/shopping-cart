<?php

$capsule = new Illuminate\Database\Capsule\Manager();

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'port'      => '3306',
    'database'  => 'cart',
    'username'  => 'root',
    'password'  => 'root',
    'charset'   => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix'    => '',
]);

$capsule->setAsGlobal();

$capsule->bootEloquent();
