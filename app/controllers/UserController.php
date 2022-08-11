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
        $userName = $_POST['user-name'];
        $userEmail = $_POST['user-email'];
        $userPassword = $_POST['user-password'];

        $curlController = new CurlController();
        $emailState = $curlController->getEmailState($userEmail);

        $isEmailValid = false;
        if ($emailState === "deliverable") {
            $isEmailValid = true;
        }

        if ($isEmailValid) {
            $user->store($userName, $userEmail, $userPassword);
        }

        View::make('index', ['isEmailValid' => $isEmailValid]);
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
        View::make('index', ['token' => $jwtToken]);
    }

    public function logoutUser()
    {
        View::make('index', ['logout' => true]);
    }


    public function test()
    {
        echo "test...";
    }


}