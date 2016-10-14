<?php

class Id
{
    /**
     * @var int
     */
    private $id;

    public function __construct(Counter $counter)
    {
        $this->id = $counter->getNewNumber();
    }

    public function getId() : int
    {
        return $this->id;
    }
}
