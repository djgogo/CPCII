<?php

namespace Suxx\Integration {

    use Suxx\Exceptions\CommentTableGatewayException;
    use Suxx\Gateways\CommentTableDataGateway;
    use Suxx\Loggers\ErrorLogger;

    /**
     * @covers  Suxx\Gateways\CommentTableDataGateway
     * @uses    Suxx\Loggers\ErrorLogger
     */
    class CommentPersistenceIntegrationTest extends \PHPUnit_Framework_TestCase
    {
        /**
         * @var \PHPUnit_Framework_MockObject_MockObject | \PDO
         */
        private $pdo;

        /**
         * @var CommentTableDataGateway
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
            $this->gateway = new CommentTableDataGateway($this->pdo, $this->logger);
        }

        public function testIfInsertFailsThrowsExceptionAndErrorWillBeLogged()
        {
            $this->expectException(CommentTableGatewayException::class);

            $this->pdo
                ->expects($this->once())
                ->method('prepare')
                ->will($this->throwException($this->e));

            $this->logger
                ->expects($this->once())
                ->method('log')
                ->with('Kommentar konnte nicht eingefügt werden.', $this->e);

            $this->gateway->insert(array());
        }

        public function testIfCommentsCouldNotBeFoundThrowsExceptionAndWillBeLogged()
        {
            $this->expectException(CommentTableGatewayException::class);

            $this->pdo
                ->expects($this->once())
                ->method('prepare')
                ->will($this->throwException($this->e));

            $this->logger
                ->expects($this->once())
                ->method('log')
                ->with('Kommentare konnten nicht ausgelesen werden.', $this->e);

            $this->gateway->findCommentsByPid(0);
        }
    }
}
