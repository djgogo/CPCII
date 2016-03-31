<?php


class CheeseburgerRecipeTest extends PHPUnit_Framework_TestCase
{
    public function testCorrectOrderOfIngredients()
    {
        $recipe = new CheeseburgerRecipe();

        $expected = [
            'LowerBread',
            'Sauce',
            'Salad',
            'Patty',
            'Cheese',
            'Tomato',
            'UpperBread'
        ];

        foreach ($recipe->getIngredientNameCollection() as $key => $ingredient) {
            $this->assertEquals($expected[$key], $ingredient);
        }
    }

}
