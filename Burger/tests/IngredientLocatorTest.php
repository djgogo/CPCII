<?php

class IngredientLocatorTest extends PHPUnit_Framework_TestCase
{
    private $ingredientFactory;
    private $ingredientLocator;

    public function setUp()
    {
        $this->ingredientFactory = $this->getMockBuilder(IngredientFactory::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @dataProvider provideInstance
     * @param $className
     * @param $ingredientName
     */
    public function testGetIngredient($className, $ingredientName)
    {
        $this->ingredientFactory
            ->expects($this->once())
            ->method('create' . $ingredientName)
            ->will($this->returnValue(new $className));

        $this->ingredientLocator = new IngredientLocator($this->ingredientFactory);

        $ingredient = $this->ingredientLocator->getIngredient($ingredientName);

        $this->assertInstanceOf($className, $ingredient);
    }

    public function provideInstance()
    {
        return [
            [Cheese::class, 'Cheese'],
            [Salad::class, 'Salad'],
            [Sauce::class, 'Sauce'],
            [Tomato::class, 'Tomato'],
            [Patty::class, 'Patty'],
            [LowerBread::class, 'LowerBread'],
            [UpperBread::class, 'UpperBread']
        ];
    }

}
