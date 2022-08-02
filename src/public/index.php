<?php

// PDO connection, distributing "$db" variable to models.

// Routing, rendering views.

$router = new Router();

$router
    ->get('/self-authoring/index', [\app\controllers\UserController::class, 'index']);

$router->run($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);



