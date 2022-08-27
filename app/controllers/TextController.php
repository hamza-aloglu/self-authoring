<?php

namespace app\controllers;

use app\attributes\Get;
use app\attributes\Post;
use app\models\TextModel;
use Doctrine\Common\Util\Debug;

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

    #[Post('/self-authoring/getTexts')]
    public function getTextsOfUser()
    {

        $uid = json_decode(file_get_contents('php://input', true));
        $text = new TextModel();
        $texts = $text->fetchTextsOfUser((int)$uid);

        $contentOfTexts = [];
        foreach ($texts as $text)
        {
            $contentOfTexts[$text->id] = $text->writing . $text->createdAt->format('Y-m-d');
        }

        echo json_encode($contentOfTexts);
    }

    #[Get('/self-authoring/doctrineArray')]
    public function test()
    {
        $text = new TextModel();
        $texts = $text->fetchTextsOfUser(5);

        $contentOfTexts = [];
        foreach ($texts as $text)
        {
            $contentOfTexts[$text->id] = $text->writing;
            var_dump($text->createdAt->format('Y-m-d H:i:s'));
        }

        $contentOfTexts = json_encode($contentOfTexts);

        echo "<pre>";
        var_dump($contentOfTexts);
        echo "</pre>";

        $contentOfTexts = json_decode($contentOfTexts);

        echo "<pre>";
        var_dump((array)$contentOfTexts);
        echo "</pre>";
    }


}