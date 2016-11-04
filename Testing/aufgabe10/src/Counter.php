<?php
declare(strict_types = 1);

class Counter
{
    /**
     * @var int
     */
    private $lastNumber = 0;

    public function getNewNumber() : int
    {
        $newNumber = $this->lastNumber + 1;
        $this->lastNumber = $newNumber;
        return $newNumber;
    }
}

