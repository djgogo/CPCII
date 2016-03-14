<?php

class Card {

    /**
     * @var string
     */
    private $color;

    /**
     * @var bool
     */
    private $turned = false;

    /**
     * Card constructor.
     * @param string $color
     */
    public function __construct(string $color)
    {
        $this->color = $color;
    }

    /**
     * @return string
     */
    public function getColor():string
    {
        return $this->color;
    }

    /**
     *  turn card
     */
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
    