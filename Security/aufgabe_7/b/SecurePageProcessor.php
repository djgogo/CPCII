<?php

class SecurePageProcessor implements ProcessorInterface
{
    public function execute(HttpRequest $request)
    {
        return 'SecurePage';
    }

}
