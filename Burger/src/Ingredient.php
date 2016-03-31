<?php


abstract class Ingredient
{
    /**
     * @var Price
     */
    private $price;

    /**
     * @param Price $price
     */
    public function __construct(Price $price)
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    abstract public function getName() : string;

    /**
     * @return Price
     */
    public function getPrice() : Price
    {
        return $this->price;
    }
}