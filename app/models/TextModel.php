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
        $this->em->find(User::class, $uid); // without finding user of text, cannot find the text.
        $stmt = $this->em->createQuery('SELECT t FROM app\entities\Text t WHERE t.user = ' . $uid);
        return $stmt->getResult();
    }

    public function fetchText(int $tid, int $uid): string
    {
        $this->em->find(User::class, $uid); // without finding user of text, cannot find the text.
        $stmt = $this->em->createQuery('SELECT t FROM app\entities\Text t WHERE t.id = ' . $tid);
        $text = $stmt->getResult()[0];

        return $text->writing;
    }
}