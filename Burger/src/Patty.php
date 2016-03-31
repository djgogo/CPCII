<?php


class Patty implements Ingredient
{
    /**
     * @return string
     */
    public function getName() : string
    {
        return 'Patty';
    }

    /**
     * @return Price
     */
    public function getPrice() : Price
    {
        return new Price(500);
    }
}