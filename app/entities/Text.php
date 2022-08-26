<?php

namespace app\entities;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;


#[Entity]
#[Table('texts')]
class Text
{
    #[Column, GeneratedValue]
    private int $id;

    #[Column(type: Types::TEXT)]
    private string $writing;

    #[Column(name: 'user_id')]
    private int $userId;

    #[Column(name: 'created_at')]
    private \DateTime $createdAt;

    #[ManyToOne(inversedBy: 'texts')]
    private User $user;


    public function setUser(User $user): void
    {
        $this->user = $user;
    }
}