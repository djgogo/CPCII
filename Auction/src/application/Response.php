<?php
declare(strict_types=1);

class Response
{
    private $headers = [];
    private $body    = '';

    public function addHeader(string $header)
    {
        $this->headers[] = $header;
    }

    public function setBody(string $body)
    {
        $this->body = $body;
    }

    public function send()
    {
        foreach ($this->headers as $header) {
            header($header);
        }

        print $this->body;
    }

    public function getHeaders() : array
    {
        return $this->headers;
    }

    public function getBody() : string
    {
        return $this->body;
    }
}
