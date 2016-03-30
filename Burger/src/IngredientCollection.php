<?php

class IngredientCollection implements Iterator
{
    /**
     * @var string
     */
    private $ingredients = array();

    /**
     * @param string $ingredient
     */
    public function add($ingredient)
    {
        $this->ingredients[] = $ingredient;
    }

    /**
     * @return boolean
     */
    public function hasIngredients() : bool
    {
        return count($this->ingredients) > 0;
    }

    public function current() : Ingredient
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