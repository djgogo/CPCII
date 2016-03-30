<?php


abstract class Recipe
{
    /**
     * @var Ingredient[]
     */
    private $ingredients;

    /**
     * @param Ingredient[] ...$ingredients
     */
    public function __construct(Ingredient ...$ingredients)
    {
        $this->ingredients = $ingredients;
    }

    /**
     * @return Ingredient[]
     */
    public function getIngredients()
    {
        return $this->ingredients;
    }
}