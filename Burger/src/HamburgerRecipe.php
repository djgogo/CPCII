<?php


class HamburgerRecipe extends Recipe
{
    public function __construct()
    {
        parent::__construct(new Tomato, new Patty, new Sauce, new Salad);
    }
}