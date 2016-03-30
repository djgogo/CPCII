<?php

abstract class Recipe
{
    /**
     * @var string[]
     */
    private $ingredients;

    /**
     * @var IngredientCollection
     */
    private $ingredientCollection;

    /**
     * @param string[] $ingredients
     */
    public function __construct(array $ingredients)
    {
        $this->ingredients = $ingredients;
    }

    /**
     * @return IngredientCollection
     */
    public function getIngredientCollection()
    {
        if ($this->ingredientCollection === null) {
            $this->ingredientCollection = new IngredientCollection();

            foreach ($this->ingredients as $ingredient) {
                $this->ingredientCollection->add($ingredient);
            }
        }

        return $this->ingredientCollection;
    }
}