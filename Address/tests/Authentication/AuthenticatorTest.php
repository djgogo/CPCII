<?php

namespace Address\Authentication
{
    use Address\Gateways\UserTableDataGateway;

    /**
     * @covers Address\Authentication\Authenticator
     * @uses   Address\Gateways\UserTableDataGateway
     */
    class AuthenticatorTest extends \PHPUnit_Framework_TestCase
    {
        /** @var UserTableDataGateway | \PHPUnit_Framework_MockObject_MockObject */
        private $database;

        /** @var Authenticator */
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
            $username = 'addressUser';
            $password = 'addressApp';

            $this->database
                ->expects($this->once())
                ->method('findUserByCredentials')
                ->willReturn(true);

            $this->assertTrue($this->authenticator->authenticate($username, $password));
        }
    }
}
