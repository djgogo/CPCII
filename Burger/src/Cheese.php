<?php


class Cheese implements Ingredient
{
    /**
     * @return string
     */
    public function getName() : string
    {
        return 'Cheese';
    }

    /**
     * @return Price
     */
    public function getPrice() : Price
    {
        return new Price(100);
    }
}