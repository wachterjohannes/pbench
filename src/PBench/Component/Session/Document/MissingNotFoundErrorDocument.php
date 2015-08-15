<?php

namespace PBench\Component\Session\Document;

class MissingNotFoundErrorDocument extends ErrorDocument
{
    public function __construct()
    {
        parent::__construct('not_found', 'missing');
    }
}
