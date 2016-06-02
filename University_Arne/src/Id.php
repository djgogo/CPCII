<?php
declare(strict_types = 1);

class Id extends UUID
{
    /**
     * @var string
     */
    private $id;

    public function __construct()
    {
        $this->id = $this->generateUUID();
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return $this->id;
    }
}