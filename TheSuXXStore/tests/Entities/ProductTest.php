<?php

namespace Suxx\Entities {

    /**
     * @covers Suxx\Entities\Product
     */
    class ProductTest extends \PHPUnit_Framework_TestCase
    {
        /**
         * @var Product
         */
        private $product;

        /**
         * @var \ReflectionClass
         */
        private $reflection;

        protected function setUp()
        {
            $this->product = new Product();
            $this->reflection = new \ReflectionClass($this->product);
        }

        public function testPidCanBeRetrieved()
        {
            $reflectionProperty = $this->reflection->getProperty('pid');
            $reflectionProperty->setAccessible(true);
            $reflectionProperty->setValue($this->product, 123);

            $this->assertEquals(123, $this->product->getPid());
        }

        public function testLabelCanBeRetrieved()
        {
            $reflectionProperty = $this->reflection->getProperty('label');
            $reflectionProperty->setAccessible(true);
            $reflectionProperty->setValue($this->product, 'Technics SL-1210');

            $this->assertEquals('Technics SL-1210', $this->product->getLabel());
        }

        public function testImageCanBeRetrieved()
        {
            $reflectionProperty = $this->reflection->getProperty('img');
            $reflectionProperty->setAccessible(true);
            $reflectionProperty->setValue($this->product, 'bla.jpg');

            $this->assertEquals('bla.jpg', $this->product->getImg());
        }

        public function testPriceCanBeRetrieved()
        {
            $reflectionProperty = $this->reflection->getProperty('price');
            $reflectionProperty->setAccessible(true);
            $reflectionProperty->setValue($this->product, '6666');

            $this->assertEquals('6666', $this->product->getPrice());
        }

        public function testCreatedCanBeRetrieved()
        {
            $reflectionProperty = $this->reflection->getProperty('created');
            $reflectionProperty->setAccessible(true);
            $reflectionProperty->setValue($this->product, '2016-11-04 00:00:00');

            $this->assertEquals('2016-11-04 00:00:00', $this->product->getCreated());
        }

        public function testUpdatedCanBeRetrieved()
        {
            $reflectionProperty = $this->reflection->getProperty('updated');
            $reflectionProperty->setAccessible(true);
            $reflectionProperty->setValue($this->product, '2016-11-09 00:00:00');

            $this->assertEquals('2016-11-09 00:00:00', $this->product->getUpdated());
        }
    }
}
