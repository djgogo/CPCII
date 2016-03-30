<?php


class HamburgerRecipe extends Recipe
{
    public function __construct()
    {
        parent::__construct(
            new LowerBread,
            new Sauce,
            new Salad,
            new Patty,
            new Tomato,
            new UpperBread
        );
    }
}