<?php

abstract class Recipe
{
    /**
     * @var IngredientNameCollection
     */
    private $ingredientNameCollection;

    /**
     * @param IngredientNameCollection $ingredientNameCollection
     */
    public function __construct(IngredientNameCollection $ingredientNameCollection)
    {
        $this->ingredientNameCollection = $ingredientNameCollection;
    }

    /**
     * @return IngredientNameCollection
     */
    public function getIngredientNameCollection()
    {
        foreach ($this->getIngredients() as $ingredient) {
            $this->ingredientNameCollection->add($ingredient);
        }

        return $this->ingredientNameCollection;
    }

    /**
     * @return array
     */
    abstract protected function getIngredients() : array;
}