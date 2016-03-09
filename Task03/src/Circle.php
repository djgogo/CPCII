<?php

class Circle implements Figure
{
    /**
     * @var float
     */
    private $radius;

    /**
     * Circle constructor.
     * @param float $radius
     */
    public function __construct(float $radius)
    {
        $this->radius = $radius;
    }

    /**
     * @return float
     */
    public function getScope():float
    {
        return $this->getDiagonal() * M_PI;
    }

    /**
     * @return float
     */
    public function getDiagonal():float
    {
        return $this->radius * 2;
    }

    /**
     * @return float
     */
    public function getArea():float
    {
        return pow($this->radius,2) * M_PI;
    }
}