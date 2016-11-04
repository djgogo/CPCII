<?php
declare(strict_types = 1);

interface RequestInterface
{
    public function set($key, $value);
    public function get($key);
}

