<?php

namespace Suxx\Authentication
{
    use Suxx\Gateways\UserTableDataGateway;

    /**
     * @covers Suxx\Authentication\Authenticator
     * @uses   Suxx\Gateways\UserTableDataGateway
     */
    class AuthenticatorTest extends \PHPUnit_Framework_TestCase
    {
        /**
         * @var \PHPUnit_Framework_MockObject_MockObject | UserTableDataGateway
         */
        private $database;

        /**
         * @var Authenticator
         */
        private $authenticator;

        protected function setUp()
        {
            $this->database = $this->getMockBuilder(UserTableDataGateway::class)
                ->disableOriginalConstructor()
                ->getMock();

            $this->authenticator = new Authenticator($this->database);
        }

        public function testUserCanBeAuthenticated()
        {
            $username = 'suxx';
            $password = '123456';

            $this->database
                ->expects($this->once())
                ->method('findUserByCredentials')
                ->willReturn(true);

            $this->assertTrue($this->authenticator->authenticate($username, $password));
        }
    }
}
