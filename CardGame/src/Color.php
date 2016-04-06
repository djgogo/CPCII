<?php

class Color
{
    /**
     * @var string
     */
    private $color;

    /**
     * Color constructor.
     * @param string $color
     */
    public function __construct(string $color)
    {
        $allowedColors = array('Red', 'Green', 'Blue', 'White', 'Black', 'Yellow');
        if (!in_array($color, $allowedColors)) {
            throw new InvalidArgumentException("Ungültige Farbe $color übergeben");
        }
        $this->color = $color;
    }

    /**
     * @return string
     */
    public function __toString()
    {
       return $this->color;
    }

}