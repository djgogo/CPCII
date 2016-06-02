<?php
declare(strict_types=1);

class Redirect
{
    private $target;

    public function __construct(string $target)
    {
        $this->target = $target;
    }

    public function getTarget() : string
    {
        return $this->target;
    }
}
