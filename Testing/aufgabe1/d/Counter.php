<?php
declare(strict_types = 1);

class Counter
{
    /**
     * @var int
     */
    private $current = 0;

    /**
     * @var int
     */
    private $increment = 1;

    /**
     * Inkrementiert den Zählerstand und liefert ihn zurück.
     *
     * @return int
     */
    public function next() : int
    {
        $this->current += $this->increment;
        return $this->current;
    }

    /**
     * Setzt das Inkrement
     *
     * @param $increment
     * @throws InvalidArgumentException
     */
    public function setIncrement($increment)
    {
        if (!is_integer($increment) || $increment < 1) {
            throw new InvalidArgumentException;
        }
        $this->increment = $increment;
    }
}

