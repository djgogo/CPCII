<?php


class HamburgerRecipeTest extends PHPUnit_Framework_TestCase
{
    public function testCorrectOrderOfIngredients()
    {
        $recipe = new HamburgerRecipe();

        $expected = [
            LowerBread::class,
            Sauce::class,
            Salad::class,
            Patty::class,
            Tomato::class,
            UpperBread::class
        ];

        foreach ($recipe as $i => $ingredient) {
            $this->assertEquals(get_class($ingredient), $expected[$i]);
        }
    }
}
