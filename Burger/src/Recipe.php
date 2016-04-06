<?php

abstract class Recipe
{
    /**
     * @return IngredientNameCollection
     */
    public function getIngredientNames() : IngredientNameCollection
    {
        $ingredientNames = new IngredientNameCollection();

        foreach ($this->getIngredients() as $ingredient) {
            $ingredientNames->add($ingredient);
        }

        return $ingredientNames;
    }

    /**
     * @return array
     */
    abstract protected function getIngredients() : array;

    /**
     * @return string
     */
    abstract public function getBurgerName() : string;
}