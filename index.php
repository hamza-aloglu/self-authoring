<?php

require_once __DIR__ . '/src/vendor/autoload.php';

use app\Router;
use app\controllers\UserController;

$router = new Router();

$router
    ->get('/self-authoring/index', [UserController::class, 'index'])
    ->post('/self-authoring/store', [UserController::class, 'store']);


$router->run($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);



