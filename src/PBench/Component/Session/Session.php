<?php

namespace PBench\Component\Session;

use PBench\Component\Session\Document\DatabaseStatusDocument;
use PBench\Component\Session\Document\MissingNotFoundErrorDocument;
use PBench\Component\Session\Exception\SessionException;
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

    /**
     * {@inheritdoc}
     */
    public function getDocument($id, $revision = null)
    {
        if (!$revision) {
            $this->storage->getDocument($id);
        }

        return $this->storage->getDocumentRevision($id, $revision);
    }

    /**
     * {@inheritdoc}
     */
    public function getDocumentRevisions($id, $revisions = array())
    {
        return $this->storage->getDocumentRevisions($id, $revisions);
    }

    /**
     * {@inheritdoc}
     */
    public function getSynchronizedChange($name, $revision)
    {
        $result = $this->storage->getSynchronizedChange($name, $revision);

        if (!$result) {
            throw new SessionException(new MissingNotFoundErrorDocument(), 404);
        }

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function storeSynchronizedChange($revisionDocument)
    {
        // TODO: Implement storeSynchronizedChange() method.
    }
}
