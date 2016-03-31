<?php


class IngredientCollectionTest extends PHPUnit_Framework_TestCase
{
    private $ingredient1;
    private $ingredient2;

    public function setUp()
    {
        $this->ingredient1 = 'LowerBread';

        $this->ingredient2 = 'UpperBread';
    }

    public function testAddAndRetrieveIngredients()
    {
        $collection = new IngredientCollection();

        $collection->add($this->ingredient1);
        $collection->add($this->ingredient2);

        $expected = [$this->ingredient1, $this->ingredient2];

        foreach ($collection as $key => $ingredient) {
            $this->assertEquals($expected[$key], $ingredient);
        }
    }

    public function testHasIngredients()
    {
        $collection = new IngredientCollection();

        $this->assertFalse($collection->hasIngredients());

        $collection->add($this->ingredient1);

        $this->assertTrue($collection->hasIngredients());

        $collection->add($this->ingredient2);

        $this->assertTrue($collection->hasIngredients());
    }

}
