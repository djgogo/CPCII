<?php

class Card {

    /**
     * @var Color
     */
    private $color;

    /**
     * @var bool
     */
    private $turned = false;

    /**
     * Card constructor.
     * @param Color $color
     */
    public function __construct(Color $color)
    {
        $this->color = $color;
    }

    /**
     * @return Color
     */
    public function getColor():Color
    {
        return $this->color;
    }

    public function turn()
    {
        $this->turned = true;
    }

    /**
     * @return bool
     */
    public function isRevealed()
    {
        return $this->turned;
    }
    
}
    