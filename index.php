<?php

require_once __DIR__ . '/vendor/autoload.php';


use app\controllers\JWTController;
use app\Router;
use app\controllers\UserController;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$router = new Router();

// Available routes
$router
    ->get('/self-authoring/index', [UserController::class, 'index'])
    ->post('/self-authoring/registerUser', [UserController::class, 'registerUser'])
    ->post('/self-authoring/loginUser', [UserController::class, 'loginUser'])
    ->post('/self-authoring/logoutUser', [UserController::class, 'logoutUser'])
    ->post('/self-authoring/isValidJWT', [JWTController::class, 'isValidJWT'])
    ->get('/self-authoring/test', [UserController::class, 'test']);


$router->run($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);

// run -> UserController -> View



