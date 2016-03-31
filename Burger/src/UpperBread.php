<?php


class UpperBread implements Ingredient
{
    /**
     * @return string
     */
    public function getName() : string
    {
        return 'UpperBread';
    }

    /**
     * @return Price
     */
    public function getPrice() : Price
    {
        return new Price(300);
    }
}