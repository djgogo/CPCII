<?php

class BurgerBuilder
{
    /**
     * @var IngredientLocator
     */
    private $ingredientLocator;

    /**
     * @param Recipe $recipe
     * @return Burger
     */
    public function build(Recipe $recipe)
    {
        $ingredientCollection = $recipe->getIngredientCollection();

        $ingredients = [];

        foreach ($ingredientCollection as $ingredient) {
            $ingredients[] = $this->ingredientLocator->getIngredient($ingredient);
        }

        return new Burger($ingredients);
    }
}