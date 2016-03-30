<?php


class BurgerFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Recipe
     */
    private $recipe;

    public function setUp()
    {
        $this->recipe = $this->getMockBuilder(Recipe::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testCreateBurger()
    {
        $ingredients = [
            $this->getMockBuilder(Ingredient::class)->disableOriginalConstructor()->getMock(),
            $this->getMockBuilder(Ingredient::class)->disableOriginalConstructor()->getMock()
        ];

        $this->recipe
            ->expects($this->at(0))
            ->method('rewind');

        // Ingredient 1

        $this->recipe
            ->expects($this->at(1))
            ->method('valid')
            ->will($this->returnValue(true));

        $this->recipe
            ->expects($this->at(2))
            ->method('current')
            ->will($this->returnValue($ingredients[0]));

        $this->recipe
            ->expects($this->at(3))
            ->method('next');

        // Ingredient 2

        $this->recipe
            ->expects($this->at(4))
            ->method('valid')
            ->will($this->returnValue(true));

        $this->recipe
            ->expects($this->at(5))
            ->method('current')
            ->will($this->returnValue($ingredients[1]));

        $this->recipe
            ->expects($this->at(6))
            ->method('next');

        $burgerFactory = new BurgerFactory();
        $burger = $burgerFactory->createBurger($this->recipe);

        $this->assertEquals(
            $ingredients,
            $burger->getIngredients()
        );
    }
}
