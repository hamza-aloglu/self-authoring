<?php

require_once __DIR__ . '/src/vendor/autoload.php';

use app\Router;
use app\controllers\UserController;

$router = new Router();

// Available routes
$router
    ->get('/self-authoring/index', [UserController::class, 'index'])
    ->post('/self-authoring/registerUser', [UserController::class, 'registerUser'])
    ->post('/self-authoring/loginUser', [UserController::class, 'loginUser']);


$router->run($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);



