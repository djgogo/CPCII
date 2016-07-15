<?php
declare(strict_types = 1);

class MovedPermanentlyStatusHeader extends AbstractHTTPStatusHeader
{
    protected function generateStatusMessage()
    {
        $this->statusMessage = 'HTTP/1.0 301 Moved Permanently';
    }
}
