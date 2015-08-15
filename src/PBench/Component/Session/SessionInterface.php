<?php

namespace PBench\Component\Session;

use PBench\Component\Session\Document\DocumentInterface;

interface SessionInterface
{
    public function getDatabaseStatus();

    /**
     * Get document
     *
     * @param string $id
     * @param string $revision
     *
     * @return DocumentInterface
     */
    public function getDocument($id, $revision = null);

    /**
     * Get document revisions
     *
     * @param string $id
     * @param string[] $revisions
     *
     * @return DocumentInterface[]
     */
    public function getDocumentRevisions($id, $revisions = array());

    /**
     * Check if change exists
     *
     * @param string $name
     * @param string $revision
     *
     * @return DocumentInterface
     */
    public function getSynchronizedChange($name, $revision);

    /**
     * Store synced change
     * Returns the revision of the created document.
     *
     * @param array $revisionDocument
     *
     * @return string
     */
    public function storeSynchronizedChange($revisionDocument);
}
