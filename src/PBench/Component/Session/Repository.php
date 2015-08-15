<?php

namespace PBench\Component\Session;

use PBench\Component\Storage\StorageInterface;

class Repository implements RepositoryInterface
{
    /**
     * @var MapperInterface[]
     */
    private $mappers = [];

    /**
     * @var StorageInterface
     */
    private $storage;

    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
    }

    public function addDatabaseMapper($name, MapperInterface $mapper)
    {
        return $this->mappers[$name] = $mapper;
    }

    public function login($databaseName)
    {
        return new Session($databaseName, $this->mappers[$databaseName], $this->storage);
    }

    public function has($name)
    {
        return array_key_exists($name, $this->mappers);
    }
}
