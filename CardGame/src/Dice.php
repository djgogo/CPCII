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
    public function roll():Color
    {
        $this->shuffleColors();
        return $this->colors[0];
    }

    /**
     * @param $i
     * @return Color
     */
    public function getColor($i):Color
    {
        return $this->colors[$i];
    }

    /**
     * @codeCoverageIgnore Weil der Zufall lässt sich so schlecht vorhersehen
     */
    public function shuffleColors()
    {
        shuffle($this->colors);
    }
}