<?php

namespace app;

class Model extends Database {
    protected \PDO $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = $this->getDB();
    }

}