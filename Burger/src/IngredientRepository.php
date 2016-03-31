<?php

class IngredientRepository
{
    /**
     * @var array
     */
    private $ingredients = array();

    /**
     * @param string $ingredientClassName
     */
    public function getIngredient($ingredientClassName)
    {
        foreach ($this->ingredients as $key => $ingredient) {
            if ($ingredient instanceof $ingredientClassName) {
                unset($this->ingredients[$key]);
                return $ingredient;
            }
        }

        throw new RuntimeException(sprintf('No more ingredients of type "%s" available.', $ingredientClassName));
    }

    /**
     * @param Ingredient $ingredient
     */
    public function addIngredient(Ingredient $ingredient)
    {
        $this->ingredients[] = $ingredient;
    }
}