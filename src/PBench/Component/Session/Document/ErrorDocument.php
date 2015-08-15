<?php

namespace PBench\Component\Session\Document;

class ErrorDocument implements DocumentInterface
{
    /**
     * @var string
     */
    private $error;

    /**
     * @var string
     */
    private $reason;

    public function __construct($error, $reason)
    {
        $this->error = $error;
        $this->reason = $reason;
    }

    /**
     * {@inheritdoc}
     */
    function jsonSerialize()
    {
        return [
            'error' => $this->error,
            'reason' => $this->reason,
        ];
    }
}
