<?php

class BurgerBuilder
{
    /**
     * @var IngredientRepository
     */
    private $ingredientRepository;

    /**
     * BurgerBuilder constructor.
     * @param IngredientRepository $ingredientRepository
     */
    public function __construct(IngredientRepository $ingredientRepository)
    {
        $this->ingredientRepository = $ingredientRepository;
    }

    /**
     * @param Recipe $recipe
     * @return Burger
     */
    public function build(Recipe $recipe)
    {
        $ingredientNameCollection = $recipe->getIngredientNames();

        if (!$ingredientNameCollection->hasIngredients()) {
            throw new RuntimeException('No ingredients in collection, cannot build a burger');
        }

        $ingredients = [];

        foreach ($ingredientNameCollection as $ingredient) {
            $ingredients[] = $this->ingredientRepository->getIngredient($ingredient);
        }

        return new Burger($recipe->getBurgerName(), ...$ingredients);
    }
}