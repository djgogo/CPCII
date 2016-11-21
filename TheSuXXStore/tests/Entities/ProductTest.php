<?php

/**
 * @covers SuxxProduct
 */
class SuxxProductTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SuxxProduct
     */
    private $product;

    /**
     * @var ReflectionClass
     */
    private $magic;

    protected function setUp()
    {
        $this->product = new SuxxProduct();
        $this->magic = new ReflectionClass($this->product);
    }

    public function testPidCanBeRetrieved()
    {
        $reflectionProperty = $this->magic->getProperty('pid');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($this->product, 123);

        $this->assertEquals(123, $this->product->getPid());
    }

    public function testLabelCanBeRetrieved()
    {
        $reflectionProperty = $this->magic->getProperty('label');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($this->product, 'Technics SL-1210');

        $this->assertEquals('Technics SL-1210', $this->product->getLabel());
    }

    public function testImageCanBeRetrieved()
    {
        $reflectionProperty = $this->magic->getProperty('img');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($this->product, 'bla.jpg');

        $this->assertEquals('bla.jpg', $this->product->getImg());
    }

    public function testPriceCanBeRetrieved()
    {
        $reflectionProperty = $this->magic->getProperty('price');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($this->product, '6666');

        $this->assertEquals('6666', $this->product->getPrice());
    }

    public function testCreatedCanBeRetrieved()
    {
        $reflectionProperty = $this->magic->getProperty('created');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($this->product, '2016-11-04 00:00:00');

        $this->assertEquals('2016-11-04 00:00:00', $this->product->getCreated());
    }

    public function testUpdatedCanBeRetrieved()
    {
        $reflectionProperty = $this->magic->getProperty('updated');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($this->product, '2016-11-09 00:00:00');

        $this->assertEquals('2016-11-09 00:00:00', $this->product->getUpdated());
    }
}

