<?php


class CheeseburgerRecipeTest extends PHPUnit_Framework_TestCase
{
    public function testCorrectOrderOfIngredients()
    {
        $recipe = new CheeseburgerRecipe();

        $expected = [
            LowerBread::class,
            Sauce::class,
            Salad::class,
            Patty::class,
            Cheese::class,
            Tomato::class,
            UpperBread::class,
        ];

        foreach ($recipe as $key => $ingredient) {
            $this->assertEquals($expected[$key], get_class($ingredient));
        }
    }

}
