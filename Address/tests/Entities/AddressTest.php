<?php

namespace Address\Entities {

    /**
     * @covers Address\Entities\Address
     */
    class AddressTest extends \PHPUnit_Framework_TestCase
    {
        /** @var Address */
        private $address;

        /** @var \ReflectionClass */
        private $reflection;

        protected function setUp()
        {
            $this->address = new Address();
            $this->reflection = new \ReflectionClass($this->address);
        }

        /**
         * @dataProvider provideAddressValues
         * @param string $property
         * @param string $value
         * @param string $method
         */
        public function testAddressTableValuesCanBeRetrieved(string $property, string $value, string $method)
        {
            $reflectionProperty = $this->reflection->getProperty($property);
            $reflectionProperty->setAccessible(true);
            $reflectionProperty->setValue($this->address, $value);

            $this->assertEquals($value, $this->address->{$method}());
        }

        public function provideAddressValues(): array
        {
            return [
                ['id', '123', 'getId'],
                ['address1', 'Obi-Van Kenobi', 'getAddress1'],
                ['address2', 'Naboo Avenue', 'getAddress2'],
                ['city', 'Galaxy', 'getCity'],
                ['postalCode', '9999', 'getPostalCode'],
                ['created', '2017-01-25 00:00:00', 'getCreated'],
                ['updated', '2017-01-25 00:00:00', 'getUpdated']
            ];
        }
    }
}
