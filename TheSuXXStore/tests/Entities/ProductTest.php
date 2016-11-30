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

        /**
         * @dataProvider provideProductValues
         * @param $property
         * @param $value
         * @param $method
         */
        public function testProductTableValuesCanBeRetrieved($property, $value, $method)
        {
            $reflectionProperty = $this->reflection->getProperty($property);
            $reflectionProperty->setAccessible(true);
            $reflectionProperty->setValue($this->product, $value);

            $this->assertEquals($value, $this->product->{$method}());
        }

        public function provideProductValues()
        {
            return [
                ['pid', 123, 'getPid'],
                ['label', 'Technics SL-1210', 'getLabel'],
                ['img', 'bla.jpg', 'getImg'],
                ['price', '6666', 'getPrice'],
                ['created', '2016-11-04 00:00:00', 'getCreated'],
                ['updated', '2016-11-09 00:00:00', 'getUpdated']
            ];
        }
    }
}
