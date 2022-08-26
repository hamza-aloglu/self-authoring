<?php

namespace app;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Exception;

/**
 * @mixin Connection
 */
class Database
{
    private Connection $connection;

    public function __construct(array $config)
    {
        try {
            $this->connection = DriverManager::getConnection($config);
        } catch (Exception $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    // for calling pdo's functions such as $pdo->query() from models. In my case, $db->query() in models.
    public function __call(string $name, array $arguments)
    {
        return call_user_func_array([$this->connection, $name], $arguments);
    }

}