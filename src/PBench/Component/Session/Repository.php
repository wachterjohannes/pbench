<?php

namespace PBench\Component\Session;

class Repository implements RepositoryInterface
{
    private $databaseMappers = [];

    public function addDatabaseMapper($name, DatabaseMapperInterface $mapper)
    {
        return $this->databaseMappers[$name] = $mapper;
    }

    public function login($databaseName)
    {
        return new DatabaseSession($this->databaseMappers[$databaseName]);
    }
}
