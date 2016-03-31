<?php

class IngredientNameCollection implements Iterator
{
    /**
     * @var array
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

    public function current() : string
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
        return is_string(current($this->ingredients));
    }

    public function rewind()
    {
        return reset($this->ingredients);
    }
}