<?php

namespace app\controllers;

use app\View;
use app\models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

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

        $jwt = JWT::encode($payload, $_ENV['JWT_SECRET'], $_ENV['JWT_ALGO']);

        // it will save encrypted token in local storage of client.
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
        $jwtToken = json_decode(file_get_contents('php://input', true));

        $secretKey = $_ENV['JWT_SECRET'];
        $jwtAlgorithm = $_ENV['JWT_ALGO'];

        $isValid = true;
        try{
            JWT::decode($jwtToken, new Key($secretKey, $jwtAlgorithm));
        } catch (\Exception $e) {
            $isValid = false;
        }

        echo json_encode($isValid);
    }
}