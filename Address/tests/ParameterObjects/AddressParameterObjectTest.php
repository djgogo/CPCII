<?php

namespace Address\ParameterObjects
{
    /**
     * @covers Address\ParameterObjects\AddressParameterObject
     */
    class AddressParameterObjectTest extends \PHPUnit_Framework_TestCase
    {
        /** @var AddressParameterObject */
        private $addressParameter;

        protected function setUp()
        {
            $this->addressParameter = new AddressParameterObject(
                123,
                'Obi-Van Kenobi',
                'Naboo Avenue',
                'Galaxy',
                9999,
                '2017-01-25 00:00:00'
            );
        }

        /**
         * @dataProvider provideAddressValues
         * @param $value
         * @param $method
         */
        public function testValuesCanBeRetrieved(string $value, string $method)
        {
            $this->assertEquals($value, $this->addressParameter->$method());
        }

        public function provideAddressValues(): array
        {
            return [
                ['123', 'getId'],
                ['Obi-Van Kenobi', 'getAddress1'],
                ['Naboo Avenue', 'getAddress2'],
                ['Galaxy', 'getCity'],
                ['9999', 'getPostalCode'],
                ['2017-01-25 00:00:00', 'getUpdated']
            ];
        }
    }
}
