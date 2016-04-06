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
        $price = new Price(new Amount(5), new Currency('foo'));

        return [
            [Cheese::class, array($price)],
            [Salad::class, array($price)],
            [Sauce::class, array($price)],
            [Tomato::class, array($price)],
            [Patty::class, array($price)],
            [LowerBread::class, array($price)],
            [UpperBread::class, array($price)]
        ];
    }

}