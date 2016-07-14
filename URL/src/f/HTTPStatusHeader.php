<?php
declare(strict_types = 1);

class HTTPStatusHeader
{
    /**
     * @var int
     */
    private $statusCode;
    /**
     * @var string
     */
    private $statusMessage;

    public function __construct(int $statusCode)
    {
        $this->ensureValid($statusCode);
        $this->generateStatusMessage();
    }

    private function ensureValid(int $statusCode)
    {
        if ($statusCode !== 200 && $statusCode !== 404) {
            throw new \InvalidHTTPStatusHeaderException("Der übergebene Status Code: $statusCode ist ungültig");
        }
        $this->statusCode = $statusCode;
    }

    private function generateStatusMessage()
    {
        if ($this->statusCode === 404) {
            $this->statusMessage = 'HTTP/1.0 404 Not Found';
        } else {
            $this->statusMessage = 'HTTP/1.0 200 OK';
        }
    }

    public function __toString() : string
    {
        return $this->statusMessage;
    }

}
