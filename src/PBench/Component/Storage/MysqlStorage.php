<?php

namespace PBench\Component\Storage;

class MysqlStorage implements StorageInterface
{
    /**
     * {@inheritdoc}
     */
    public function getDocumentCount($name)
    {
        return 0;
    }

    /**
     * {@inheritdoc}
     */
    public function getUpdateSequence($name)
    {
        return 0;
    }
}
