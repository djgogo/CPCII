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

        /** @var \PDOException */
        private $exception;

        protected function setUp()
        {
            $this->pdo = $this->getMockBuilder(\PDO::class)->disableOriginalConstructor()->getMock();
            $this->logger = $this->getMockBuilder(ErrorLogger::class)->disableOriginalConstructor()->getMock();
            $this->dataGateway = new TextTableDataGateway($this->pdo, $this->logger);
            $this->exception = new \PDOException();
        }

        public function testPdoExceptionIsLoggedAndRethrownInGetAllTexts()
        {
            $this->expectException(TextTableGatewayException::class);

            $this->pdo
                ->expects($this->once())
                ->method('prepare')
                ->willThrowException($this->exception);

            $this->logger
                ->expects($this->once())
                ->method('log')
                ->with('Fehler beim lesen aller Datensätze der Text Tabelle.', $this->exception);

            $this->dataGateway->getAllTexts();
        }

        public function testPdoExceptionIsLoggedAndRethrownInGetAllTextsOrderedByUpdatedAscending()
        {
            $this->expectException(TextTableGatewayException::class);

            $this->pdo
                ->expects($this->once())
                ->method('prepare')
                ->willThrowException($this->exception);

            $this->logger
                ->expects($this->once())
                ->method('log')
                ->with('Fehler beim lesen aller Datensätze der Text Tabelle aufsteigend sortiert.', $this->exception);

            $this->dataGateway->getAllTextsOrderedByUpdatedAscending();
        }

        public function testPdoExceptionIsLoggedAndRethrownInGetAllTextsOrderedByUpdatedDescending()
        {
            $this->expectException(TextTableGatewayException::class);

            $this->pdo
                ->expects($this->once())
                ->method('prepare')
                ->willThrowException($this->exception);

            $this->logger
                ->expects($this->once())
                ->method('log')
                ->with('Fehler beim lesen aller Datensätze der Text Tabelle absteigend sortiert.', $this->exception);

            $this->dataGateway->getAllTextsOrderedByUpdatedDescending();
        }

        public function testPdoExceptionIsLoggedAndRethrownInGetSearchedText()
        {
            $this->expectException(TextTableGatewayException::class);

            $this->pdo
                ->expects($this->once())
                ->method('prepare')
                ->willThrowException($this->exception);

            $this->logger
                ->expects($this->once())
                ->method('log')
                ->with('Fehler beim lesen der Text Tabelle mit Search-Parameter.', $this->exception);

            $this->dataGateway->getSearchedText('searchString');
        }

        public function testPdoExceptionIsLoggedAndRethrownInFindTextById()
        {
            $this->expectException(TextTableGatewayException::class);

            $this->pdo
                ->expects($this->once())
                ->method('prepare')
                ->willThrowException($this->exception);

            $this->logger
                ->expects($this->once())
                ->method('log')
                ->with('Fehler beim lesen der Text Tabelle mit Id-Parameter.', $this->exception);

            $this->dataGateway->findTextById(9999);
        }

        public function testPdoExceptionIsLoggedAndRethrownInUpdate()
        {
            $this->expectException(TextTableGatewayException::class);

            $this->pdo
                ->expects($this->once())
                ->method('prepare')
                ->willThrowException($this->exception);

            $this->logger
                ->expects($this->once())
                ->method('log')
                ->with('Fehler beim ändern eines Datensatzes der Text Tabelle.', $this->exception);

            $this->dataGateway->update(array());
        }
    }
}
