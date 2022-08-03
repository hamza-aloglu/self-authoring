<?php

namespace app;

use PDO;

class Database
{
    private PDO $db;

    public function __construct()
    {
        $this->db = new PDO("mysql:host=localhost;dbname=self-authoring", "root");
        // set the PDO error mode to exception
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully";
    }

    public function getDB(): PDO
    {
        return $this->db;
    }

}