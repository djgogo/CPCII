<?php
declare(strict_types = 1);

class TemporaryRedirectedStatusHeader extends AbstractHTTPStatusHeader
{
    protected function generateStatusMessage()
    {
        $this->statusMessage = 'HTTP/1.0 307 Temporary Redirected';
    }
}
