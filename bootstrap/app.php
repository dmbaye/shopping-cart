<?php

ini_set('display_errors', E_ALL);

session_start();

require_once __DIR__ . '/../vendor/autoload.php';

$app = new App\App;

$container = $app->getContainer();

// try {
//     $dotenv = new Dotenv\Dotenv(__DIR__ . '/../');
//     $dotenv->load();
// } catch (Exception $e) {
// }

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/middlewares.php';
require_once __DIR__ . '/../routes/web.php';
