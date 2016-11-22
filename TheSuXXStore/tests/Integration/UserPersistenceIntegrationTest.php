<?php

namespace Suxx\Integration {

    use Suxx\Exceptions\UserTableGatewayException;
    use Suxx\Gateways\UserTableDataGateway;
    use Suxx\Loggers\ErrorLogger;

    /**
     * @covers Suxx\Gateways\UserTableDataGateway
     * @uses   Suxx\Loggers\ErrorLogger
     */
    class UserPersistenceIntegrationTest extends \PHPUnit_Framework_TestCase
    {
        /**
         * @var \PHPUnit_Framework_MockObject_MockObject | \PDO
         */
        private $pdo;

        /**
         * @var UserTableDataGateway
         */
        private $gateway;

        /**
         * @var \PHPUnit_Framework_MockObject_MockObject | ErrorLogger
         */
        private $logger;

        /**
         * @var \PDOException
         */
        private $e;

        protected function setUp()
        {
            $this->logger = $this->getMockBuilder(ErrorLogger::class)->disableOriginalConstructor()->getMock();
            $this->pdo = $this->getMockBuilder(\PDO::class)->disableOriginalConstructor()->getMock();
            $this->e = new \PDOException();
            $this->gateway = new UserTableDataGateway($this->pdo, $this->logger);
        }

        public function testIfInsertUserFailsThrowsExceptionAndErrorWillBeLogged()
        {
            $row = [
                'password' => '123456'
            ];

            $this->expectException(UserTableGatewayException::class);

            $this->pdo
                ->expects($this->once())
                ->method('prepare')
                ->will($this->throwException($this->e));

            $this->logger
                ->expects($this->once())
                ->method('log')
                ->with('Benutzer konnte nicht eingefügt werden.', $this->e);

            $this->gateway->insert($row);
        }

        public function testIfUserCredentialsCouldNotBeFoundThrowsExceptionAndWillBeLogged()
        {
            $this->expectException(UserTableGatewayException::class);

            $this->pdo
                ->expects($this->once())
                ->method('prepare')
                ->will($this->throwException($this->e));

            $this->logger
                ->expects($this->once())
                ->method('log')
                ->with('Benutzer konnte nicht gefunden werden.', $this->e);

            $this->gateway->findUserByCredentials('any', 'invalid');
        }

        public function testIfUserNameCouldNotBeFoundThrowsExceptionAndWillBeLogged()
        {
            $this->expectException(UserTableGatewayException::class);

            $this->pdo
                ->expects($this->once())
                ->method('prepare')
                ->will($this->throwException($this->e));

            $this->logger
                ->expects($this->once())
                ->method('log')
                ->with('Benutzer konnte nicht gefunden werden.', $this->e);

            $this->gateway->findUserByUsername('any');
        }
    }
}

