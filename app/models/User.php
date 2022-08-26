<?php

namespace app\models;

use app\Model;

class User extends Model
{
    // For making data and behaviour together (for encapsulation) we can put "email, password, name" properties in
    // constructor. We should put multiple constructors, so we can use this model in different places.
    // multiple constructor yaparsak bazı fonksiyonları kullanırken acaba bu constructorla bu fonksiyon kullanılabilir mi
    // diye düşünüp sürekli User'ın içini kontrol edeceğiz ki bizim engellemeye çalıştığımız şey bu.

    public function getAll(): bool|array
    {
        return $this->db->query('SELECT * FROM users')->fetchAllAssociative();
    }

    public function isRegistered(string $email, string $password): bool
    {
        $stmt = $this->db->prepare('SELECT email, password FROM users WHERE email = :email AND password = :password');
        $stmt->bindValue("email", $email);
        $stmt->bindValue("password", $password);

        // if such a user exists returns true, otherwise false.
        return (bool)count($stmt->executeQuery()->fetchAllAssociative());
    }

    public function store(string $name, string $email, string $password)
    {
        $stmt = $this->db->prepare('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
        $stmt->bindValue(":name", $name);
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":password", $password);

        $stmt->executeStatement();
    }
}