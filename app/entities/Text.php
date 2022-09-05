<?php

namespace app\entities;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;


#[Entity]
#[Table('texts')]
class Text
{
    #[Id]
    #[Column, GeneratedValue]
    protected int $id;

    #[Column(type: Types::TEXT)]
    private string $writing;

    #[Column(name: 'created_at')]
    private \DateTime $createdAt;

    #[ManyToOne(inversedBy: 'texts')]
    private User $user;

    public function create(?string $writing, User $user): self
    {
        $this->writing = $writing;
        $this->user = $user;
        $this->createdAt = new \DateTime('now');
        return $this;
    }

    public function __get(string $name)
    {
        return $this->{$name};
    }

    public function __set(string $name, $value): void
    {
        $this->{$name} = $value;
    }
}