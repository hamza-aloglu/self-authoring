<?php

declare(strict_types=1);

namespace app\controllers;

use app\attributes\Post;
use app\models\JWT;
use app\View;
use app\models\UserModel;

class UserController
{
    #[Post('/self-authoring/registerUser')]
    public function registerUser(): View
    {
        $user = new UserModel();
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

    #[Post('/self-authoring/loginUser')]
    public function loginUser(): View
    {
        $email = $_POST['user-email'];
        $password = $_POST['user-password'];

        $user = new UserModel();

        if (!$user->isRegistered($email, $password)) {
            die("not registered");
        }

        $uid = $user->getId($email);

        $jwt = new JWT();
        $jwtToken = $jwt->create();

        // it will save encrypted token in local storage of client since token variable is sent.
        return View::make('index', ['token' => $jwtToken, 'uid' => $uid]);

    }

    #[Post('/self-authoring/logoutUser')]
    public function logoutUser(): View
    {
        return View::make('index', ['logout' => true]);
    }


    public function test()
    {
        echo "test...";
    }


}