<?php

namespace PBench\Component\Storage;

interface StorageInterface
{
    /**
     * @param string $name
     * @return int
     */
    public function getDocumentCount($name);

    /**
     * @param string $name
     *
     * @return int
     */
    public function getUpdateSequence($name);
}
