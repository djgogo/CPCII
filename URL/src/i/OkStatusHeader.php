<?php
declare(strict_types = 1);

class OkStatusHeader extends AbstractHTTPStatusHeader
{
    protected function generateStatusMessage()
    {
        $this->statusMessage = 'HTTP/1.0 200 OK';
    }
}
