<?php

namespace app\controllers;

use app\View;
use app\models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;


class UserController
{
    public function index()
    {
        View::make('index');
    }

    public function registerUser()
    {
        $user = new User();
        $user->store($_POST['user-name'], $_POST['user-email'], $_POST['user-password']);

        header('Location: /self-authoring/index');
    }

    public function loginUser()
    {
        $email = $_POST['user-email'];
        $password = $_POST['user-password'];

        // find corresponding user by email then check password.
        $user = new User();
        if (!$user->isRegisteredUser($email, $password)) {
            die("not registered");
        }

        // generate token
        $key = $password;
        $payload = [
            'iss' => 'localhost',
            'aud' => 'localhost',
        ];

        $jwt = JWT::encode($payload, $key, 'HS256');
        $decoded = JWT::decode($jwt, new Key($key, 'HS256'));

        // save encrypted token in local storage of client.
        View::make('index', ['token' => $jwt]);
    }

    public function logoutUser()
    {
        View::make('index', ['logout' => true]);
    }
}