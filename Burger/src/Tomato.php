<?php


class Tomato implements Ingredient
{
    /**
     * @return string
     */
    public function getName() : string
    {
        return 'Tomato';
    }

    /**
     * @return Price
     */
    public function getPrice() : Price
    {
        return new Price(50);
    }
}