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

    public function fetchTextsOfUser(int $uid)
    {
        $user = $this->em->find(User::class, $uid);

        $stmt = $this->em->createQuery('SELECT t FROM app\entities\Text t WHERE t.user = ' . $uid);

        return $stmt->getResult();
    }
}