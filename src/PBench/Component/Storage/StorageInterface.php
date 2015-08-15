<?php

namespace PBench\Component\Storage;

use PBench\Component\Session\Document\DocumentInterface;

interface StorageInterface
{
    /**
     * Get document count
     *
     * @param string $name
     *
     * @return int
     */
    public function getDocumentCount($name);

    /**
     * Get update sequence
     *
     * @param string $name
     *
     * @return int
     */
    public function getUpdateSequence($name);

    /**
     * Get document
     *
     * @param string $id
     *
     * @return DocumentInterface
     */
    public function getDocument($id);

    /**
     * Get document revision
     *
     * @param string $id
     * @param string $revision
     *
     * @return DocumentInterface
     */
    public function getDocumentRevision($id, $revision);

    /**
     * Get document revisions
     *
     * @param string $id
     * @param string[] $revisions
     *
     * @return DocumentInterface[]
     */
    public function getDocumentRevisions($id, $revisions);

    /**
     * Get synced change
     *
     * @param string $name
     * @param string $revision
     *
     * @return DocumentInterface
     */
    public function getSynchronizedChange($name, $revision);
}
