<?php

namespace app\controllers;

use app\attributes\Post;
use app\models\TextModel;

class TextController
{
    #[Post('/self-authoring/createText')]
    public function createText()
    {
        $writing = $_POST['writing'];
        $uid = (int)$_POST['uid'];
        $TextModel = new TextModel();

        $TextModel->store($writing, $uid);

        Header('Location: /self-authoring/index');
    }

}