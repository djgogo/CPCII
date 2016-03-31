<?php


class Salad implements Ingredient
{
    /**
     * @return string
     */
    public function getName() : string
    {
        return 'Salad';
    }

    /**
     * @return Price
     */
    public function getPrice() : Price
    {
        return new Price(80);
    }
}