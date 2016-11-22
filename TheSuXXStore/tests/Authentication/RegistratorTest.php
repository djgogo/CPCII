<?php

namespace Suxx\Authentication {

    use Suxx\Gateways\UserTableDataGateway;

    /**
     * @covers Suxx\Authentication\Registrator
     * @uses   Suxx\Gateways\UserTableDataGateway
     */
    class RegistratorTest extends \PHPUnit_Framework_TestCase
    {
        /**
         * @var \PHPUnit_Framework_MockObject_MockObject | UserTableDataGateway
         */
        private $database;

        /**
         * @var Registrator
         */
        private $registrator;

        protected function setUp()
        {
            $this->database = $this->getMockBuilder(UserTableDataGateway::class)
                ->disableOriginalConstructor()
                ->getMock();

            $this->registrator = new Registrator($this->database);
        }

        public function testUserCanBeRegistered()
        {
            $row = [
                'username' => 'foo',
                'password' => '123456',
                'email' => 'foo@bar.com',
                'name' => 'foo bar',
                'description' => 'Suxx Account'
            ];

            $this->database
                ->expects($this->once())
                ->method('insert')
                ->willReturn(true);

            $this->assertTrue($this->registrator->register($row));
        }

        public function testUsernameCanBeFound()
        {
            $username = 'harrypotter';

            $this->database
                ->expects($this->once())
                ->method('findUserByUsername')
                ->willReturn(true);

            $this->assertTrue($this->registrator->usernameExists($username));
        }
    }
}
