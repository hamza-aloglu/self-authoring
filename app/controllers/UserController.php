<?php

declare(strict_types=1);

namespace app\controllers;

use app\models\JWT;
use app\View;
use app\models\User;

class UserController
{

    public function index(array $attributes = null): View
    {
        return View::make('index', ['attributes' => $attributes]);
    }

    public function registerUser(): View
    {
        $user = new User();
        $userName = $_POST['user-name'];
        $userEmail = $_POST['user-email'];
        $userPassword = $_POST['user-password'];

        $curlController = new CurlController();
        // IEmailState $emailState;
        $emailState = $curlController->getEmailState($userEmail);

        $isEmailValid = $emailState->isValid();
        if ($isEmailValid) {
            $user->store($userName, $userEmail, $userPassword);
        }

        return View::make('index', ['isEmailValid' => $isEmailValid, 'emailValidationMessage' => $emailState]);
    }

    public function loginUser(): View
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

        // it will save encrypted token in local storage of client since token variable is sent.
        return View::make('index', ['token' => $jwtToken]);
    }

    public function logoutUser(): View
    {
        return View::make('index', ['logout' => true]);
    }


    public function test()
    {
        echo "test...";
    }


}