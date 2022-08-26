<?php

namespace app\models;

use app\entities\User;
use app\Model;

class UserModel extends Model
{

    public function isRegistered(string $email, string $password): bool
    {
        $stmt = $this->em->createQuery('SELECT u FROM app\entities\User u WHERE u.email = :email AND u.password = :password');

        $stmt->setParameter("email", $email);
        $stmt->setParameter("password", $password);

        // if such a user exists returns true, otherwise false.
        return (bool)count($stmt->getArrayResult());
    }

    public function store(string $name, string $email, string $password)
    {
        $user = new User();

        $user = $user->create($name, $email, $password);

        $this->em->persist($user);
        $this->em->flush();
    }
}