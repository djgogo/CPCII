<?php


class CheeseburgerRecipe extends Recipe
{
    /**
     * @return array
     */
    protected function getIngredients() : array
    {
        return [
            'LowerBread',
            'Sauce',
            'Salad',
            'Patty',
            'Cheese',
            'Tomato',
            'UpperBread'
        ];
    }

    public function getBurgerName() : string
    {
        return 'Cheeseburger';
    }

}