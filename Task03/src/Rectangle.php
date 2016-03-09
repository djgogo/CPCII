<?php

class Rectangle implements Figure
{
    /**
     * @var float
     */
    private $aSide;
    /**
     * @var float
     */
    private $bSide;

    /**
     * Rectangle constructor.
     * @param float $aSide
     * @param float $bSide
     */
    public function __construct(float $aSide, float $bSide)
    {
        $this->aSide = $aSide;
        $this->bSide = $bSide;
    }

    /**
     * @return float
     */
    public function getScope():float
    {
       return ($this->aSide + $this->bSide) * 2;
    }

    /**
     * @return float
     */
    public function getDiagonal():float
    {
        return sqrt(pow($this->aSide,2) + pow($this->bSide,2));
    }

    /**
     * @return float
     */
    public function getArea():float
    {
        return $this->aSide * $this->bSide;
    }

    protected function getSideA()
    {
        return $this->aSide;
    }
}