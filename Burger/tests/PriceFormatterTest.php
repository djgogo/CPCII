<?php

class PriceFormatterTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var PriceFormatter
     */
    private $priceFormatter;

    protected function setUp()
    {
        $this->priceFormatter = new PriceFormatter();
    }

    /**
     * @dataProvider pricesProvider
     */
    public function testFormatWorks($price, $formattedPrice)
    {
        $this->assertEquals($formattedPrice, $this->priceFormatter->format($price));
    }

    public function pricesProvider()
    {
        return array(
            array('1', '0.01'),
            array('100', '1.00'),
            array('111', '1.11'),
            array('1000', '10.00'),
            array('1337', '13.37'),
            array('1000000', '10\'000.00'),
        );
    }
}
