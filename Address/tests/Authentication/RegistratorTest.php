<?php

namespace Address\Authentication {

    use Address\Exceptions\UserTableGatewayException;
    use Address\Gateways\UserTableDataGateway;
    use Address\ParameterObjects\UserParameterObject;

    /**
     * @covers Address\Authentication\Registrator
     * @uses Address\Gateways\UserTableDataGateway
     * @uses Address\ParameterObjects\UserParameterObject
     */
    class RegistratorTest extends \PHPUnit_Framework_TestCase
    {
        /** @var UserTableDataGateway | \PHPUnit_Framework_MockObject_MockObject */
        private $database;

        /** @var Registrator */
        private $registrator;

        /** @var UserParameterObject | \PHPUnit_Framework_MockObject_MockObject */
        private $parameterObject;

        protected function setUp()
        {
            $this->database = $this->getMockBuilder(UserTableDataGateway::class)
                ->disableOriginalConstructor()
                ->getMock();

            $this->parameterObject = $this->getMockBuilder(UserParameterObject::class)
                ->disableOriginalConstructor()
                ->getMock();

            $this->registrator = new Registrator($this->database);
        }

        public function testUserCanBeRegistered()
        {
            $this->database
                ->expects($this->once())
                ->method('insert')
                ->with($this->parameterObject)
                ->willReturn(true);

            $this->assertTrue($this->registrator->register($this->parameterObject));
        }

        public function testRegistratorCatchesExceptionIfUserRegistrationFails()
        {
            $this->database
                ->expects($this->once())
                ->method('insert')
                ->with($this->parameterObject)
                ->willThrowException(new UserTableGatewayException());

            $this->assertFalse($this->registrator->register($this->parameterObject));
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
