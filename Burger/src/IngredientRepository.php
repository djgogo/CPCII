<?php

class IngredientRepository
{
    /**
     * @var array
     */
    private $ingredients = [];


    /**
     * @param string $ingredientName
     * @return Ingredient
     */
    public function getIngredient($ingredientName) : Ingredient
    {
        if (!isset($this->ingredients[$ingredientName])) {
            throw new RuntimeException(sprintf('No ingredients of type "%s" available.', $ingredientName));
        }

        if (count($this->ingredients[$ingredientName]) === 0) {
            throw new RuntimeException(sprintf('No more ingredients of type "%s" available.', $ingredientName));
        }

        return array_pop($this->ingredients[$ingredientName]);
    }

    /**
     * @param Ingredient $ingredient
     */
    public function addIngredient(Ingredient $ingredient)
    {
        $this->ingredients[$ingredient->getName()][] = $ingredient;
    }
}