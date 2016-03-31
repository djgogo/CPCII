<?php


interface Ingredient
{
    /**
     * @return string
     */
    public function getName() : string;

    /**
     * @return Price
     */
    public function getPrice() : Price;
}