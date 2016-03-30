<?php


abstract class Recipe implements Iterator
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

    public function current():Ingredient
    {
        return current($this->ingredients);
    }

    public function next()
    {
        return next($this->ingredients);
    }

    public function key()
    {
        return key($this->ingredients);
    }

    public function valid()
    {
        return current($this->ingredients) instanceof Ingredient;
    }

    public function rewind()
    {
        return reset($this->ingredients);
    }
}