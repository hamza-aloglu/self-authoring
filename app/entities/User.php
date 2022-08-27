<?php

namespace app\entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table('users')]
class User
{
    #[Id]
    #[Column, GeneratedValue]
    protected int $id;

    #[Column]
    private string $name;

    #[Column]
    private string $email;

    #[Column]
    private string $password;

    #[OneToMany(mappedBy: 'user', targetEntity: Text::class, cascade: ['persist', 'remove'])]
    private Collection $texts;




    public function __construct()
    {
        $this->texts = new ArrayCollection();
    }

    public function __get(string $name)
    {
        return $this->{$name};
    }

    public function __set(string $name, $value): void
    {
        $this->{$name} = $value;
    }

    public function create(string $name, string $email, string $password): self
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;

        return $this;
    }

    public function getTexts(): ArrayCollection|Collection
    {
        return $this->texts;
    }
}