<?php

namespace Address\ParameterObjects
{
    /**
     * @covers Address\ParameterObjects\UserParameterObject
     */
    class UserParameterObjectTest extends \PHPUnit_Framework_TestCase
    {
        /** @var UserParameterObject */
        private $userParameter;

        protected function setUp()
        {
            $this->userParameter = new UserParameterObject('FooBar', '123456', 'foo@bar.com');
        }

        /**
         * @dataProvider provideUserValues
         * @param $value
         * @param $method
         */
        public function testValuesCanBeRetrieved(string $value, string $method)
        {
            $this->assertEquals($value, $this->userParameter->$method());
        }

        public function provideUserValues(): array
        {
            return [
                ['FooBar', 'getUserName'],
                ['123456', 'getPassword'],
                ['foo@bar.com', 'getEmail']
            ];
        }
    }
}
