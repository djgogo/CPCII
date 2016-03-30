<?php


class CheeseburgerRecipe extends Recipe
{
    public function __construct()
    {
        parent::__construct([
            'LowerBread',
            'Sauce',
            'Salad',
            'Patty',
            'Cheese',
            'Tomato',
            'UpperBread'
        ]);
    }
}