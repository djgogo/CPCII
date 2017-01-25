<?php

namespace Address\Entities {

    class TextTest extends \PHPUnit_Framework_TestCase
    {
        /** @var Text */
        private $text;

        /** @var \ReflectionClass */
        private $reflection;

        protected function setUp()
        {
            $this->text = new Text();
            $this->reflection = new \ReflectionClass($this->text);
        }

        /**
         * @dataProvider provideTextValues
         * @param $property
         * @param $value
         * @param $method
         */
        public function testTextTableValuesCanBeRetrieved($property, $value, $method)
        {
            $reflectionProperty = $this->reflection->getProperty($property);
            $reflectionProperty->setAccessible(true);
            $reflectionProperty->setValue($this->text, $value);

            $this->assertEquals($value, $this->text->{$method}());
        }

        public function provideTextValues()
        {
            return [
                ['id', '123', 'getId'],
                ['text1', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr', 'getText1'],
                ['text2', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr', 'getText2'],
                ['created', '2017-01-25 00:00:00', 'getCreated'],
                ['updated', '2017-01-25 00:00:00', 'getUpdated']
            ];
        }
    }
}
