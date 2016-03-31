<?php


class HamburgerRecipeTest extends PHPUnit_Framework_TestCase
{
    public function testCorrectOrderOfIngredients()
    {
        $recipe = new HamburgerRecipe();

        $expected = [
            'LowerBread',
            'Sauce',
            'Salad',
            'Patty',
            'Tomato',
            'UpperBread'
        ];

        foreach ($recipe->getIngredientCollection() as $key => $ingredient) {
            $this->assertEquals($expected[$key], $ingredient);
        }
    }
}
