<?php
declare(strict_types = 1);

class OkStatusHeader extends HTTPStatusHeader
{
    protected function generateStatusMessage()
    {
        $this->statusMessage = 'HTTP/1.0 200 OK';
    }
}
