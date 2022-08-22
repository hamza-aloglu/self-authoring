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
        return $this->db->query('SELECT * FROM users')->fetchAll();
    }

    public function isRegisteredUser(string $email, string $password): bool
    {
        $stmt = $this->db->prepare('SELECT email, password FROM users WHERE email = :email AND password = :password');
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $password);
        $stmt->execute();

        // if such a user exists returns true, otherwise false.
        return (bool) count($stmt->fetchAll());
    }

    public function store(string $name, string $email, string $password)
    {
        $stmt = $this->db->prepare('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $password);

        $stmt->execute();
    }
}