<?php


class IngredientFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var IngredientFactory
     */
    private $factory;

    public function setUp()
    {
        $this->factory = new IngredientFactory();
    }

    /**
     * @dataProvider provideInstance
     * @param string $className
     * @param array $parameters
     */
    public function testCreate($className, array $parameters = array())
    {
        $method = 'create' . $className;

        $this->assertInstanceOf(
            $className,
            call_user_func_array(array($this->factory, $method), $parameters)
        );
    }

    public function provideInstance()
    {
        return [
            [Cheese::class],
            [Salad::class],
            [Sauce::class],
            [Tomato::class],
            [Patty::class],
            [LowerBread::class],
            [UpperBread::class]
        ];
    }

}