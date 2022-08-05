<?php

namespace app\controllers;

use app\View;
use app\models\User;
use Firebase\JWT\JWT;

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
        // $decoded = JWT::decode($jwt, new Key($key, 'HS256'));

        // save encrypted token in local storage of client.
        $this->index(['token' => $jwt]);
    }

    public function logoutUser()
    {
        $this->index(['logout' => true]);
    }


    public function test()
    {
        echo "test...";
    }

    public function isValidJWT()
    {
        sleep(10);

        if (empty($_POST)) {
            $_POST = json_decode(file_get_contents('php://input', true));
        }

        // decode jwt
        // check if it is valid
        // response true or false.


        echo json_encode($_POST);
    }
}