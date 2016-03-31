<?php

class BurgerBuilder
{
    /**
     * @var IngredientLocator
     */
    private $ingredientLocator;

    public function __construct(IngredientLocator $ingredientLocator)
    {
        $this->ingredientLocator = $ingredientLocator;
    }

    /**
     * @param Recipe $recipe
     * @return Burger
     */
    public function build(Recipe $recipe)
    {
        $ingredientCollection = $recipe->getIngredientCollection();

        if (!$ingredientCollection->hasIngredients()) {
            throw new RuntimeException('No ingredients in collection, cannot build a burger');
        }

        $ingredients = [];

        foreach ($ingredientCollection as $ingredient) {
            $ingredients[] = $this->ingredientLocator->getIngredient($ingredient);
        }

        return new Burger($ingredients);
    }
}