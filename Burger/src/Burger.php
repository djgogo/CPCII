<?php


class Burger
{
    /**
     * @var Ingredient[]
     */
    private $ingredients;

    // @todo add broetchen

    /**
     * @param Ingredient $ingredient
     */
    public function addIngredient(Ingredient $ingredient)
    {
        $this->ingredients[] = $ingredient;
    }
}