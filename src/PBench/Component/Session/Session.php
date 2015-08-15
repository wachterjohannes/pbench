<?php

namespace PBench\Component\Session;

use PBench\Component\Session\Document\DatabaseStatusDocument;
use PBench\Component\Storage\StorageInterface;

class Session implements SessionInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var MapperInterface
     */
    private $mapper;

    /**
     * @var StorageInterface
     */
    private $storage;

    public function __construct($name, MapperInterface $mapper, StorageInterface $storage)
    {
        $this->name = $name;
        $this->mapper = $mapper;
        $this->storage = $storage;
    }

    public function getDatabaseStatus()
    {
        $status = new DatabaseStatusDocument(
            $this->name,
            $this->storage->getDocumentCount($this->name),
            $this->storage->getUpdateSequence($this->name)
        );

        return $status;
    }
}
