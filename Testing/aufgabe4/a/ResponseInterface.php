<?php
declare(strict_types = 1);

interface ResponseInterface
{
    public function set($key, $value);
    public function get($key);
}

