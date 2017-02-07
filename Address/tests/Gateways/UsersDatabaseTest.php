<?php

namespace Address\Gateways {

    use Address\Exceptions\UserTableGatewayException;
    use Address\Loggers\ErrorLogger;
    use Address\ParameterObjects\UserParameterObject;

    /**
     * @covers Address\Gateways\UserTableDataGateway
     * @uses Address\Exceptions\UserTableGatewayException
     * @uses Address\Loggers\ErrorLogger
     * @uses Address\ParameterObjects\UserParameterObject
     */
    class UsersDatabaseText extends \PHPUnit_Framework_TestCase
    {
        /** @var \PDO | \PHPUnit_Framework_MockObject_MockObject */
        private $pdo;

        /** @var ErrorLogger | \PHPUnit_Framework_MockObject_MockObject */
        private $logger;

        /** @var UserTableDataGateway | \PHPUnit_Framework_MockObject_MockObject */
        private $dataGateway;

        /** @var \PDOException */
        private $exception;

        /** @var UserParameterObject */
        private $parameterObject;

        protected function setUp()
        {
            $this->pdo = $this->getMockBuilder(\PDO::class)->disableOriginalConstructor()->getMock();
            $this->logger = $this->getMockBuilder(ErrorLogger::class)->disableOriginalConstructor()->getMock();
            $this->parameterObject = $this->getMockBuilder(UserParameterObject::class)
                ->disableOriginalConstructor()
                ->getMock();
            $this->dataGateway = new UserTableDataGateway($this->pdo, $this->logger);
            $this->exception = new \PDOException();
        }

        public function testPdoExceptionIsLoggedAndRethrownAtInsert()
        {
            $this->expectException(UserTableGatewayException::class);

            $this->pdo
                ->expects($this->once())
                ->method('prepare')
                ->willThrowException($this->exception);

            $this->logger
                ->expects($this->once())
                ->method('log')
                ->with('Benutzer "" konnte nicht eingefügt werden.', $this->exception);

            $this->dataGateway->insert($this->parameterObject);
        }

        public function testPdoExceptionIsLoggedAndRethrownAtFindUserByCredentials()
        {
            $this->expectException(UserTableGatewayException::class);

            $this->pdo
                ->expects($this->once())
                ->method('prepare')
                ->willThrowException($this->exception);

            $this->logger
                ->expects($this->once())
                ->method('log')
                ->with('Benutzer "user" konnte nicht gefunden werden.', $this->exception);

            $this->dataGateway->findUserByCredentials('user', '123456');
        }

        public function testPdoExceptionIsLoggedAndRethrownAtFindUserByUsername()
        {
            $this->expectException(UserTableGatewayException::class);

            $this->pdo
                ->expects($this->once())
                ->method('prepare')
                ->willThrowException($this->exception);

            $this->logger
                ->expects($this->once())
                ->method('log')
                ->with('Benutzer "user" konnte nicht gefunden werden.', $this->exception);

            $this->dataGateway->findUserByUsername('user');
        }
    }
}
