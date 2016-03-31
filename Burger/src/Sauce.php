<?php


class Sauce implements Ingredient
{
    /**
     * @return string
     */
    public function getName() : string
    {
        return 'Sauce';
    }

    /**
     * @return Price
     */
    public function getPrice() : Price
    {
        return new Price(50);
    }
}