<?php

namespace Address\Gateways {

    use Address\Exceptions\TextTableGatewayException;
    use Address\Loggers\ErrorLogger;

    class TextsDatabaseText extends \PHPUnit_Framework_TestCase
    {
        /** @var \PDO | \PHPUnit_Framework_MockObject_MockObject */
        private $pdo;

        /** @var ErrorLogger | \PHPUnit_Framework_MockObject_MockObject */
        private $logger;

        /** @var TextTableDataGateway | \PHPUnit_Framework_MockObject_MockObject */
        private $dataGateway;

        protected function setUp()
        {
            $this->pdo = $this->getMockBuilder(\PDO::class)->disableOriginalConstructor()->getMock();
            $this->logger = $this->getMockBuilder(ErrorLogger::class)->disableOriginalConstructor()->getMock();
            $this->dataGateway = new TextTableDataGateway($this->pdo, $this->logger);
        }

        public function testPdoExceptionIsLoggedAndRethrownInGetAllTexts()
        {
            $exception = new \PDOException();
            $this->expectException(TextTableGatewayException::class);

            $this->pdo
                ->expects($this->once())
                ->method('prepare')
                ->willThrowException($exception);

            $this->logger
                ->expects($this->once())
                ->method('log')
                ->with('Fehler beim lesen aller Datensätze der Text Tabelle.', $exception);

            $this->dataGateway->getAllTexts();
        }

        public function testPdoExceptionIsLoggedAndRethrownInGetAllTextsOrderedByUpdatedAscending()
        {
            $exception = new \PDOException();
            $this->expectException(TextTableGatewayException::class);

            $this->pdo
                ->expects($this->once())
                ->method('prepare')
                ->willThrowException($exception);

            $this->logger
                ->expects($this->once())
                ->method('log')
                ->with('Fehler beim lesen aller Datensätze der Text Tabelle aufsteigend sortiert.', $exception);

            $this->dataGateway->getAllTextsOrderedByUpdatedAscending();
        }

        public function testPdoExceptionIsLoggedAndRethrownInGetAllTextsOrderedByUpdatedDescending()
        {
            $exception = new \PDOException();
            $this->expectException(TextTableGatewayException::class);

            $this->pdo
                ->expects($this->once())
                ->method('prepare')
                ->willThrowException($exception);

            $this->logger
                ->expects($this->once())
                ->method('log')
                ->with('Fehler beim lesen aller Datensätze der Text Tabelle absteigend sortiert.', $exception);

            $this->dataGateway->getAllTextsOrderedByUpdatedDescending();
        }

        public function testPdoExceptionIsLoggedAndRethrownInGetSearchedText()
        {
            $exception = new \PDOException();
            $this->expectException(TextTableGatewayException::class);

            $this->pdo
                ->expects($this->once())
                ->method('prepare')
                ->willThrowException($exception);

            $this->logger
                ->expects($this->once())
                ->method('log')
                ->with('Fehler beim lesen der Text Tabelle mit Search-Parameter.', $exception);

            $this->dataGateway->getSearchedText('searchString');
        }

        public function testPdoExceptionIsLoggedAndRethrownInFindTextById()
        {
            $exception = new \PDOException();
            $this->expectException(TextTableGatewayException::class);

            $this->pdo
                ->expects($this->once())
                ->method('prepare')
                ->willThrowException($exception);

            $this->logger
                ->expects($this->once())
                ->method('log')
                ->with('Fehler beim lesen der Text Tabelle mit Id-Parameter.', $exception);

            $this->dataGateway->findTextById(9999);
        }

        public function testPdoExceptionIsLoggedAndRethrownInUpdate()
        {
            $exception = new \PDOException();
            $this->expectException(TextTableGatewayException::class);

            $this->pdo
                ->expects($this->once())
                ->method('prepare')
                ->willThrowException($exception);

            $this->logger
                ->expects($this->once())
                ->method('log')
                ->with('Fehler beim ändern eines Datensatzes der Text Tabelle.', $exception);

            $this->dataGateway->update(array());
        }
    }
}
