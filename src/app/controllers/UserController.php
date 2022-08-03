<?php

namespace app\controllers;

use app\View;
use app\models\User;

class UserController
{
    public function index()
    {
        $user = new User();

        View::make('index', ['users' => $user->getAll()]);
    }

    public function store()
    {
        $user = new User();
        $user->store($_POST['name'], $_POST['email']);

        header('Location: /self-authoring/index');
    }
}