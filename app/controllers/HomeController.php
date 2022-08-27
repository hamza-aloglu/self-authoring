<?php

namespace app\controllers;

use app\attributes\Get;
use app\View;

class HomeController
{
    #[Get('/self-authoring/index')]
    public function index(): View
    {
        return View::make('index');
    }
}