<?php
declare(strict_types = 1);

interface ControllerInterface
{
    public function execute(RequestInterface $request, ResponseInterface $response);
}
