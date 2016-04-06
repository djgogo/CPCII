<?php


class PriceTest extends PHPUnit_Framework_TestCase
{
    public function testConstructionAndToString()
    {
        $testPrice = 250;

        $price = new Price($testPrice);
        $this->assertEquals((string) $testPrice, (string) $price);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testPriceBelowZero()
    {
        new Price(-5);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testPriceIsInvalid()
    {
        new Price('a5');
    }
}
