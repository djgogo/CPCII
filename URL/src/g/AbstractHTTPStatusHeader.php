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
        $this->ensureValid();
        $this->generateStatusMessage();
    }

    private function ensureValid()
    {
        if (!is_subclass_of($this, 'AbstractHTTPStatusHeader') ) {
            throw new \InvalidHTTPStatusHeaderException("Ungültiger Status-Code");
        }
    }

    abstract protected function generateStatusMessage();

    public function __toString() : string
    {
        return $this->statusMessage;
    }

}
