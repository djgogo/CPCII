<?php

class Square extends Rectangle
{
    /**
     * @var float
     */
//    private $side;

    /**
     * @var float|null
     */
    private $squareRootOfTwo;

    /**
     * Square constructor.
     * @param float $side
     */
    public function __construct(float $side)
    {
        parent::__construct($side, $side);
    }

    /**
     * @return float
     */
    public function getDiagonal():float
    {
        return $this->getSideA() * $this->getSquareRootOfTwo();
    }

    /**
     * @return float
     */
    private function getSquareRootOfTwo()
    {
        if (!isset($this->squareRootOfTwo)) {
            $this->squareRootOfTwo = sqrt(2);
        }
        return $this->squareRootOfTwo;
    }
}