<?php

namespace PBench\Component\Session;

class DatabaseSession implements DatabaseSessionInterface
{
    /**
     * @var DatabaseMapperInterface
     */
    private $mapper;

    public function __construct(DatabaseMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }
}
