<?php

require_once __DIR__ . '/vendor/autoload.php';

use app\App;
use app\Config;
use app\controllers\CurlController;
use app\controllers\JWTController;
use app\controllers\TextController;
use app\Router;
use app\controllers\UserController;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
const VIEW_PATH = __DIR__ . '/views';

$router = new Router();

$router->registerRoutesFromControllersViaMethodAttributes(
    [
        UserController::class,
        JWTController::class,
        CurlController::class,
        TextController::class
    ]
);

(new App($router, new Config($_ENV)))->run(['uri'=>$_SERVER['REQUEST_URI'], 'method'=>$_SERVER['REQUEST_METHOD']]);






