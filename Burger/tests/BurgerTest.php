<?php


class BurgerTest extends PHPUnit_Framework_TestCase
{
    private $ingredient1;
    private $ingredient2;

    public function setUp()
    {
        $this->ingredient1 = $this->getMockBuilder(Ingredient::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->ingredient2 = $this->getMockBuilder(Ingredient::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testAddIngredientAndGetIngredients()
    {
        $burger = new Burger([$this->ingredient1, $this->ingredient2]);

        $this->assertEquals(
            [$this->ingredient1, $this->ingredient2],
            $burger->getIngredients()
        );
    }
}
