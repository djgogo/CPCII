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

        protected function setUp()
        {
            $this->pdo = $this->getMockBuilder(\PDO::class)->disableOriginalConstructor()->getMock();
            $this->logger = $this->getMockBuilder(ErrorLogger::class)->disableOriginalConstructor()->getMock();
            $this->dataGateway = new AddressTableDataGateway($this->pdo, $this->logger);
        }

        public function testPdoExceptionIsLoggedAndRethrownInGetAllAddresses()
        {
            $exception = new \PDOException();
            $this->expectException(AddressTableGatewayException::class);

            $this->pdo
                ->expects($this->once())
                ->method('prepare')
                ->willThrowException($exception);

            $this->logger
                ->expects($this->once())
                ->method('log')
                ->with('Fehler beim lesen aller Datensätze der Address Tabelle.', $exception);

            $this->dataGateway->getAllAddresses();
        }

        public function testPdoExceptionIsLoggedAndRethrownInGetAllAddressesOrderedByUpdatedAscending()
        {
            $exception = new \PDOException();
            $this->expectException(AddressTableGatewayException::class);

            $this->pdo
                ->expects($this->once())
                ->method('prepare')
                ->willThrowException($exception);

            $this->logger
                ->expects($this->once())
                ->method('log')
                ->with('Fehler beim lesen aller Datensätze der Address Tabelle aufsteigend sortiert.', $exception);

            $this->dataGateway->getAllAddressesOrderedByUpdatedAscending();
        }

        public function testPdoExceptionIsLoggedAndRethrownInGetAllAddressesOrderedByUpdatedDescending()
        {
            $exception = new \PDOException();
            $this->expectException(AddressTableGatewayException::class);

            $this->pdo
                ->expects($this->once())
                ->method('prepare')
                ->willThrowException($exception);

            $this->logger
                ->expects($this->once())
                ->method('log')
                ->with('Fehler beim lesen aller Datensätze der Address Tabelle absteigend sortiert.', $exception);

            $this->dataGateway->getAllAddressesOrderedByUpdatedDescending();
        }

        public function testPdoExceptionIsLoggedAndRethrownInGetSearchedAddress()
        {
            $exception = new \PDOException();
            $this->expectException(AddressTableGatewayException::class);

            $this->pdo
                ->expects($this->once())
                ->method('prepare')
                ->willThrowException($exception);

            $this->logger
                ->expects($this->once())
                ->method('log')
                ->with('Fehler beim lesen der Address Tabelle mit Search-Parameter.', $exception);

            $this->dataGateway->getSearchedAddress('searchString');
        }

        public function testPdoExceptionIsLoggedAndRethrownInFindAddressById()
        {
            $exception = new \PDOException();
            $this->expectException(AddressTableGatewayException::class);

            $this->pdo
                ->expects($this->once())
                ->method('prepare')
                ->willThrowException($exception);

            $this->logger
                ->expects($this->once())
                ->method('log')
                ->with('Fehler beim lesen der Address Tabelle mit Id-Parameter.', $exception);

            $this->dataGateway->findAddressById(9999);
        }

        public function testPdoExceptionIsLoggedAndRethrownInUpdate()
        {
            $exception = new \PDOException();
            $this->expectException(AddressTableGatewayException::class);

            $this->pdo
                ->expects($this->once())
                ->method('prepare')
                ->willThrowException($exception);

            $this->logger
                ->expects($this->once())
                ->method('log')
                ->with('Fehler beim ändern eines Datensatzes der Adress Tabelle.', $exception);

            $this->dataGateway->update(array());
        }

        public function testPdoExceptionIsLoggedAndRethrownInDelete()
        {
            $exception = new \PDOException();
            $this->expectException(AddressTableGatewayException::class);

            $this->pdo
                ->expects($this->once())
                ->method('prepare')
                ->willThrowException($exception);

            $this->logger
                ->expects($this->once())
                ->method('log')
                ->with('Fehler beim löschen eines Datensatzes der Adress Tabelle.', $exception);

            $this->dataGateway->delete(9999);
        }
    }
}
