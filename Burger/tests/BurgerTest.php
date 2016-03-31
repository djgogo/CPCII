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

    public function testGetPrice()
    {
        $price1 = new Price(250);
        $price2 = new Price(350);

        $this->ingredient1
            ->expects($this->once())
            ->method('getPrice')
            ->will($this->returnValue($price1));

        $this->ingredient2
            ->expects($this->once())
            ->method('getPrice')
            ->will($this->returnValue($price2));

        $burger = new Burger([$this->ingredient1, $this->ingredient2]);

        $this->assertEquals('600', (string) $burger->getPrice());
    }
}
