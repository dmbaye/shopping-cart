<?php

ini_set('display_errors', 1);

session_start();

require_once __DIR__ . '/../vendor/autoload.php';

$app = new App\App;

try {
    Dotenv\Dotenv::create(__DIR__.'/../')->load();
} catch (Exception $e) {}

$container = $app->getContainer();

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/middlewares.php';
require_once __DIR__ . '/../routes/web.php';
