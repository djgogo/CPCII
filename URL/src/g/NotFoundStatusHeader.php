<?php
declare(strict_types = 1);

class NotFoundStatusHeader extends HTTPStatusHeader
{
    protected function generateStatusMessage()
    {
        $this->statusMessage = 'HTTP/1.0 404 Not Found';
    }
}
