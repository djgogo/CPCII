<?php
declare(strict_types = 1);

abstract class AbstractHTTPStatusHeader
{
    /**
     * @var string
     */
    protected $statusMessage;

    public function __construct()
    {
        $this->generateStatusMessage();
    }

    abstract protected function generateStatusMessage();

    public function __toString() : string
    {
        return $this->statusMessage;
    }

}
