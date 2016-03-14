<?php

class Dice
{
    /**
     * @var array
     */
    private $colors;

    /**
     * Dice constructor.
     */
    public function __construct()
    {
        $this->colors = array(
            new Color('Red'),
            new Color('Blue'),
            new Color('Green'),
            new Color('Yellow'),
            new Color('Black'),
            new Color('White')
        );
    }

    /**
     * @return string
     */
    public function roll()
    {
        shuffle($this->colors);
        return $this->colors[0];
    }
}