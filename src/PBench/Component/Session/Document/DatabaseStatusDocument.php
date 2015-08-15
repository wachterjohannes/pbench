<?php

namespace PBench\Component\Session\Document;

class DatabaseStatusDocument implements DocumentInterface
{
    /**
     * @var string
     */
    private $dbName = null;

    /**
     * @var int
     */
    private $docCount = 0;

    /**
     * @var int
     */
    private $docDelCount = 0;

    /**
     * @var int
     */
    private $updateSeq = 0;

    /**
     * @var int
     */
    private $purgeSeq = 0;

    /**
     * @var bool
     */
    private $compactRunning = false;

    /**
     * @var int
     */
    private $diskSize = 0;

    /**
     * @var int
     */
    private $dataSize = 0;

    /**
     * @var int
     */
    private $instanceStartTime = 0;

    /**
     * @var int
     */
    private $diskFormatVersion = 0;

    /**
     * @var int
     */
    private $committedUpdateSeq = 0;

    /**
     * DatabaseStatusDocument constructor.
     * @param string $dbName
     * @param int $docCount
     * @param int $updateSeq
     */
    public function __construct($dbName, $docCount, $updateSeq)
    {
        $this->dbName = $dbName;
        $this->docCount = $docCount;
        $this->updateSeq = $updateSeq;
    }

    /**
     * @return null
     */
    public function getDbName()
    {
        return $this->dbName;
    }

    /**
     * @return int
     */
    public function getDocCount()
    {
        return $this->docCount;
    }

    /**
     * @return int
     */
    public function getDocDelCount()
    {
        return $this->docDelCount;
    }

    /**
     * @param int $docDelCount
     * @return DatabaseStatusDocument
     */
    public function setDocDelCount($docDelCount)
    {
        $this->docDelCount = $docDelCount;

        return $this;
    }

    /**
     * @return int
     */
    public function getUpdateSeq()
    {
        return $this->updateSeq;
    }

    /**
     * @return int
     */
    public function getPurgeSeq()
    {
        return $this->purgeSeq;
    }

    /**
     * @param int $purgeSeq
     * @return DatabaseStatusDocument
     */
    public function setPurgeSeq($purgeSeq)
    {
        $this->purgeSeq = $purgeSeq;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isCompactRunning()
    {
        return $this->compactRunning;
    }

    /**
     * @param boolean $compactRunning
     * @return DatabaseStatusDocument
     */
    public function setCompactRunning($compactRunning)
    {
        $this->compactRunning = $compactRunning;

        return $this;
    }

    /**
     * @return int
     */
    public function getDiskSize()
    {
        return $this->diskSize;
    }

    /**
     * @param int $diskSize
     * @return DatabaseStatusDocument
     */
    public function setDiskSize($diskSize)
    {
        $this->diskSize = $diskSize;

        return $this;
    }

    /**
     * @return int
     */
    public function getDataSize()
    {
        return $this->dataSize;
    }

    /**
     * @param int $dataSize
     * @return DatabaseStatusDocument
     */
    public function setDataSize($dataSize)
    {
        $this->dataSize = $dataSize;

        return $this;
    }

    /**
     * @return int
     */
    public function getInstanceStartTime()
    {
        return $this->instanceStartTime;
    }

    /**
     * @param int $instanceStartTime
     * @return DatabaseStatusDocument
     */
    public function setInstanceStartTime($instanceStartTime)
    {
        $this->instanceStartTime = $instanceStartTime;

        return $this;
    }

    /**
     * @return int
     */
    public function getDiskFormatVersion()
    {
        return $this->diskFormatVersion;
    }

    /**
     * @param int $diskFormatVersion
     * @return DatabaseStatusDocument
     */
    public function setDiskFormatVersion($diskFormatVersion)
    {
        $this->diskFormatVersion = $diskFormatVersion;

        return $this;
    }

    /**
     * @return int
     */
    public function getCommittedUpdateSeq()
    {
        return $this->committedUpdateSeq;
    }

    /**
     * @param int $committedUpdateSeq
     * @return DatabaseStatusDocument
     */
    public function setCommittedUpdateSeq($committedUpdateSeq)
    {
        $this->committedUpdateSeq = $committedUpdateSeq;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    function jsonSerialize()
    {
        return [
            'db_name' => $this->dbName,
            'doc_count' => $this->docCount,
            'doc_del_count' => $this->docDelCount,
            'update_seq' => $this->updateSeq,
            'purge_seq' => $this->purgeSeq,
            'compact_running' => $this->compactRunning,
            'disk_size' => $this->diskSize,
            'data_size' => $this->dataSize,
            'instance_start_time' => $this->instanceStartTime,
            'disk_format_version' => $this->diskFormatVersion,
            'committed_update_seq' => $this->committedUpdateSeq,
        ];
    }
}
