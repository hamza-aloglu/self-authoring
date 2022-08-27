<?php

namespace app\models;

use app\entities\Text;
use app\entities\User;
use app\Model;

class TextModel extends Model
{
    public function store(?string $writing, int $uid)
    {
        $text = new Text();
        $user = $this->em->find(User::class, $uid);

        $text = $text->create($writing, $user);

        $this->em->persist($text);
        $this->em->flush();
    }
}