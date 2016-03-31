<?php


class BurgerBuilderTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Recipe
     */
    private $recipe;
    /**
     * @var IngredientNameCollection
     */
    private $ingredientCollection;
    /**
     * @var IngredientLocator
     */
    private $ingredientLocator;

    public function setUp()
    {
        $this->recipe = $this->getMockBuilder(Recipe::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->ingredientLocator = $this->getMockBuilder(IngredientLocator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->ingredientCollection = new IngredientNameCollection();
    }

    public function testBuildBurgerFromRecipe()
    {
        $this->ingredientCollection->add('LowerBread');
        $this->ingredientCollection->add('Cheese');
        $this->ingredientCollection->add('UpperBread');

        $lowerBread = new LowerBread();
        $cheese = new Cheese();
        $upperBread = new UpperBread();

        $this->ingredientLocator
            ->expects($this->at(0))
            ->method('getIngredient')
            ->will($this->returnValue($lowerBread));

        $this->ingredientLocator
            ->expects($this->at(1))
            ->method('getIngredient')
            ->will($this->returnValue($cheese));

        $this->ingredientLocator
            ->expects($this->at(2))
            ->method('getIngredient')
            ->will($this->returnValue($upperBread));

        $this->recipe
            ->expects($this->once())
            ->method('getIngredientCollection')
            ->will($this->returnValue($this->ingredientCollection));

        $burgerBuilder = new BurgerBuilder($this->ingredientLocator);
        $burger = $burgerBuilder->build($this->recipe);

        $this->assertEquals(
            [$lowerBread, $cheese, $upperBread],
            $burger->getIngredients()
        );
    }

    /**
     * @expectedException RuntimeException
     */
    public function testBuildBurgerFromEmptyRecipe()
    {
        $this->recipe
            ->expects($this->once())
            ->method('getIngredientCollection')
            ->will($this->returnValue($this->ingredientCollection));

        $burgerBuilder = new BurgerBuilder($this->ingredientLocator);
        $burgerBuilder->build($this->recipe);
    }
}
