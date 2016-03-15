<?php

class Dice
{
    /**
     * @var array
     */
    private $colors;

    /**
     * Dice constructor.
     * @param array $colors
     */
    public function __construct(array $colors)
    {
        $this->colors = $colors;
    }

    /**
     * @return Color
     */
    public function roll()
    {
        shuffle($this->colors);
        return $this->colors[0];
    }
}