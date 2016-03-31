<?php

class IngredientLocatorTest extends PHPUnit_Framework_TestCase
{
    private $ingredientRepository;
    private $ingredientLocator;

    public function setUp()
    {
        $this->ingredientRepository = $this->getMockBuilder(IngredientRepository::class)
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
        $this->ingredientRepository
            ->expects($this->once())
            ->method('getIngredient')
            ->with($className)
            ->will($this->returnValue(new $className));

        $this->ingredientLocator = new IngredientLocator($this->ingredientRepository);

        $ingredient = $this->ingredientLocator->getIngredient($ingredientName);

        $this->assertInstanceOf($className, $ingredient);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testGetIngredientWithInvalidIngredientName()
    {
        $this->ingredientRepository
            ->expects($this->never())
            ->method('getIngredient');

        $this->ingredientLocator = new IngredientLocator($this->ingredientRepository);
        $this->ingredientLocator->getIngredient('FooBar');
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
