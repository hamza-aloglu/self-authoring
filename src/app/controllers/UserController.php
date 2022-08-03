<?php

namespace app\controllers;

use app\View;
use app\models\User;

class UserController
{
    public function index()
    {
        View::make('index');
    }

    public function store()
    {
        $user = new User();
        $user->store($_POST['name'], $_POST['email']);

        header('Location: /self-authoring/index');
    }
}