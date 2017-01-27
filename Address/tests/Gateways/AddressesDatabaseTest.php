<?php

namespace Address\Gateways {

    use Address\Exceptions\AddressTableGatewayException;
    use Address\Loggers\ErrorLogger;

    class AddressesDatabaseText extends \PHPUnit_Framework_TestCase
    {
        /** @var \PDO | \PHPUnit_Framework_MockObject_MockObject */
        private $pdo;

        /** @var ErrorLogger | \PHPUnit_Framework_MockObject_MockObject */
        private $logger;

        /** @var AddressTableDataGateway | \PHPUnit_Framework_MockObject_MockObject */
        private $dataGateway;

        /** @var \PDOException */
        private $exception;

        protected function setUp()
        {
            $this->pdo = $this->getMockBuilder(\PDO::class)->disableOriginalConstructor()->getMock();
            $this->logger = $this->getMockBuilder(ErrorLogger::class)->disableOriginalConstructor()->getMock();
            $this->dataGateway = new AddressTableDataGateway($this->pdo, $this->logger);
            $this->exception = new \PDOException();
        }

        public function testPdoExceptionIsLoggedAndRethrownInGetAllAddresses()
        {
            $this->expectException(AddressTableGatewayException::class);

            $this->pdo
                ->expects($this->once())
                ->method('prepare')
                ->willThrowException($this->exception);

            $this->logger
                ->expects($this->once())
                ->method('log')
                ->with('Fehler beim lesen aller Datensätze der Address Tabelle.', $this->exception);

            $this->dataGateway->getAllAddresses();
        }

        public function testPdoExceptionIsLoggedAndRethrownInGetAllAddressesOrderedByUpdatedAscending()
        {
            $this->expectException(AddressTableGatewayException::class);

            $this->pdo
                ->expects($this->once())
                ->method('prepare')
                ->willThrowException($this->exception);

            $this->logger
                ->expects($this->once())
                ->method('log')
                ->with('Fehler beim lesen aller Datensätze der Address Tabelle aufsteigend sortiert.', $this->exception);

            $this->dataGateway->getAllAddressesOrderedByUpdatedAscending();
        }

        public function testPdoExceptionIsLoggedAndRethrownInGetAllAddressesOrderedByUpdatedDescending()
        {
            $this->expectException(AddressTableGatewayException::class);

            $this->pdo
                ->expects($this->once())
                ->method('prepare')
                ->willThrowException($this->exception);

            $this->logger
                ->expects($this->once())
                ->method('log')
                ->with('Fehler beim lesen aller Datensätze der Address Tabelle absteigend sortiert.', $this->exception);

            $this->dataGateway->getAllAddressesOrderedByUpdatedDescending();
        }

        public function testPdoExceptionIsLoggedAndRethrownInGetSearchedAddress()
        {
            $this->expectException(AddressTableGatewayException::class);

            $this->pdo
                ->expects($this->once())
                ->method('prepare')
                ->willThrowException($this->exception);

            $this->logger
                ->expects($this->once())
                ->method('log')
                ->with('Fehler beim lesen der Address Tabelle mit Search-Parameter.', $this->exception);

            $this->dataGateway->getSearchedAddress('searchString');
        }

        public function testPdoExceptionIsLoggedAndRethrownInFindAddressById()
        {
            $this->expectException(AddressTableGatewayException::class);

            $this->pdo
                ->expects($this->once())
                ->method('prepare')
                ->willThrowException($this->exception);

            $this->logger
                ->expects($this->once())
                ->method('log')
                ->with('Fehler beim lesen der Address Tabelle mit Id-Parameter.', $this->exception);

            $this->dataGateway->findAddressById(9999);
        }

        public function testPdoExceptionIsLoggedAndRethrownInUpdate()
        {
            $this->expectException(AddressTableGatewayException::class);

            $this->pdo
                ->expects($this->once())
                ->method('prepare')
                ->willThrowException($this->exception);

            $this->logger
                ->expects($this->once())
                ->method('log')
                ->with('Fehler beim ändern eines Datensatzes der Adress Tabelle.', $this->exception);

            $this->dataGateway->update(array());
        }

        public function testPdoExceptionIsLoggedAndRethrownInDelete()
        {
            $this->expectException(AddressTableGatewayException::class);

            $this->pdo
                ->expects($this->once())
                ->method('prepare')
                ->willThrowException($this->exception);

            $this->logger
                ->expects($this->once())
                ->method('log')
                ->with('Fehler beim löschen eines Datensatzes der Adress Tabelle.', $this->exception);

            $this->dataGateway->delete(9999);
        }
    }
}
