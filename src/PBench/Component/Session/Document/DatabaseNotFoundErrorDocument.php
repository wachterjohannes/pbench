<?php

namespace PBench\Component\Session\Document;

class DatabaseNotFoundErrorDocument extends ErrorDocument
{
    public function __construct()
    {
        parent::__construct('not_found', 'no_db_file');
    }
}
