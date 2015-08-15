<?php

namespace PBench\Component\Session;

interface RepositoryInterface
{
    public function login($databaseName);

    public function has($name);
}
