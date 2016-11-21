<?php

namespace Suxx {

    use Suxx\SuxxUserTableDataGateway;

    class SuxxUserPersistenceIntegrationTest extends \PHPUnit_Framework_TestCase
    {
        /**
         * @var \PHPUnit_Framework_MockObject_MockObject | \PDO
         */
        private $pdo;

        /**
         * @var \Suxx\SuxxUserTableDataGateway
         */
        private $gateway;

        /**
         * @var \PHPUnit_Framework_MockObject_MockObject | \SuxxErrorLogger
         */
        private $logger;

        /**
         * @var \PDOException
         */
        private $e;

        protected function setUp()
        {
            $this->logger = $this->getMockBuilder(\SuxxErrorLogger::class)->disableOriginalConstructor()->getMock();
            $this->pdo = $this->getMockBuilder(\PDO::class)->disableOriginalConstructor()->getMock();
            $this->e = new \PDOException();
            $this->gateway = new SuxxUserTableDataGateway($this->pdo, $this->logger);
        }

        public function testIfInsertUserFailsThrowsExceptionAndErrorWillBeLogged()
        {
            $row = [
                'password' => '123456'
            ];

            $this->expectException(\SuxxUserTableGatewayException::class);

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
            $this->expectException(\SuxxUserTableGatewayException::class);

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
            $this->expectException(\SuxxUserTableGatewayException::class);

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

