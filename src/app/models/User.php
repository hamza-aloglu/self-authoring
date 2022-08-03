<?php

namespace app\models;

use app\Model;

class User extends Model
{
    public function getAll()
    {
        return $this->db->query('SELECT * FROM users')->fetchAll();
    }

    public function store(string $name, string $email)
    {
        $stmt = $this->db->prepare('INSERT INTO users (name, email) VALUES (:name, :email)');
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":email", $email);

        $stmt->execute();
    }
}