<?php


class Burger
{
    /**
     * @var Ingredient[]
     */
    private $ingredients;

    /**
     * @param array $ingredients
     */
    public function __construct(array $ingredients)
    {
        $this->ingredients = $ingredients;
    }

    /**
     * @return Ingredient[]
     */
    public function getIngredients() : array
    {
        return $this->ingredients;
    }
}