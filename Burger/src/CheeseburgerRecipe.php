<?php


class CheeseburgerRecipe extends Recipe
{
    public function __construct()
    {
        parent::__construct(new Sauce, new Salad, new Patty, new Cheese, new Tomato);
    }
}