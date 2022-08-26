<?php

namespace app;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\ORMSetup;

/**
 * @mixin EntityManager
 */
class Database
{
    private EntityManager $em;

    public function __construct(array $config)
    {
        try {
            $setup = ORMSetup::createAttributeMetadataConfiguration(array(__DIR__ . '/entities'));
            $this->em = EntityManager::create($config, $setup);
        } catch (ORMException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }


    public function __call(string $name, array $arguments)
    {
        return call_user_func_array([$this->em, $name], $arguments);
    }

}