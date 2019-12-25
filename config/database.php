<?php

/*
|------------------------------------------------------------------------------
| Database config
|------------------------------------------------------------------------------
*/

$capsule = new Illuminate\Database\Capsule\Manager();

$capsule->addConnection([
    'driver'    => env('DB_DRIVER', 'mysql'),
    'host'      => env('DB_HOST', 'localhost'),
    'port'      => env('DB_PORT', '3306'),
    'database'  => env('DB_DATABASE', 'cart'),
    'username'  => env('DB_USERNAME', 'username'),
    'password'  => env('DB_PASSWORD', 'password'),
    'charset'   => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix'    => '',
]);

$capsule->setAsGlobal();

$capsule->bootEloquent();
