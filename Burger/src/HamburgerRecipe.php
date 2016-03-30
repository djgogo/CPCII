<?php


class HamburgerRecipe extends Recipe
{
    public function __construct()
    {
        parent::__construct([
            'LowerBread',
            'Sauce',
            'Salad',
            'Patty',
            'Tomato',
            'UpperBread'
        ]);
    }
}