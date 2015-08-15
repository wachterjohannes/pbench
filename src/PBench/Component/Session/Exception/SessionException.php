<?php

namespace PBench\Component\Session\Exception;

use PBench\Component\Session\Document\ErrorDocument;

class SessionException extends \Exception
{
    /**
     * @var ErrorDocument
     */
    private $errorDocument;

    /**
     * @var int
     */
    private $statusCode;

    /**
     * SessionException constructor.
     * @param ErrorDocument $errorDocument
     * @param int $statusCode
     */
    public function __construct(ErrorDocument $errorDocument, $statusCode)
    {
        $this->errorDocument = $errorDocument;
        $this->statusCode = $statusCode;
    }

    /**
     * @return ErrorDocument
     */
    public function getErrorDocument()
    {
        return $this->errorDocument;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }
}
