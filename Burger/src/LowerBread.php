<?php


class LowerBread implements Ingredient
{

    /**
     * @return string
     */
    public function getName() : string
    {
        return 'LowerBread';
    }

    /**
     * @return Price
     */
    public function getPrice() : Price
    {
        return new Price(300);
    }
}