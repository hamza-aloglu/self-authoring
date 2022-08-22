<?php

require_once __DIR__ . '/vendor/autoload.php';

use app\App;
use app\Config;
use app\controllers\CurlController;
use app\controllers\JWTController;
use app\Router;
use app\controllers\UserController;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
const VIEW_PATH = __DIR__ . '/views';

$router = new Router();

// Available routes
$router
    ->get('/self-authoring/index', [UserController::class, 'index'])
    ->post('/self-authoring/registerUser', [UserController::class, 'registerUser'])
    ->post('/self-authoring/loginUser', [UserController::class, 'loginUser'])
    ->post('/self-authoring/logoutUser', [UserController::class, 'logoutUser'])
    ->post('/self-authoring/isValidJWT', [JWTController::class, 'isValidJWT'])
    ->get('/self-authoring/curl', [CurlController::class, 'index'])
    ->get('/self-authoring/test', [UserController::class, 'test']);


(new App($router, new Config($_ENV)))->run(['uri'=>$_SERVER['REQUEST_URI'], 'method'=>$_SERVER['REQUEST_METHOD']]);





