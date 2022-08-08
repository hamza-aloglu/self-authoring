<?php

namespace app\controllers;

use app\models\JWT;
use app\View;
use app\models\User;

class UserController
{
    public function index(array $attributes = null)
    {
        View::make('index', ['attributes' => $attributes]);
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

        $user = new User();
        if (!$user->isRegisteredUser($email, $password)) {
            die("not registered");
        }

        $payload = [
            'iss' => 'localhost',
            'aud' => 'localhost',
        ];
        $jwt = new JWT();
        $jwtToken = $jwt->create($payload);

        // it will save encrypted token in local storage of client.
        $this->index(['token' => $jwtToken]);
    }

    public function logoutUser()
    {
        $this->index(['logout' => true]);
    }


    public function test()
    {
        echo "test...";
    }


}