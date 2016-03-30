<?php


class Burger
{
    /**
     * @var Ingredient[]
     */
    private $ingredients;

    /**
     * @param Ingredient $ingredient
     */
    public function addIngredient(Ingredient $ingredient)
    {
        $this->ingredients[] = $ingredient;
    }

    /**
     * @return Ingredient[]
     */
    public function getIngredients() : array
    {
        return $this->ingredients;
    }
}