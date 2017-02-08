<?php

namespace Address\Gateways {

    use Address\Exceptions\AddressTableGatewayException;
    use Address\Loggers\ErrorLogger;
    use Address\ParameterObjects\AddressParameterObject;

    /**
     * @covers Address\Gateways\AddressTableDataGateway
     * @uses Address\Exceptions\AddressTableGatewayException
     * @uses Address\Loggers\ErrorLogger
     * @uses Address\ParameterObjects\AddressParameterObject
     */
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

        /** @var AddressParameterObject */
        private $parameterObject;

        protected function setUp()
        {
            $this->pdo = $this->getMockBuilder(\PDO::class)->disableOriginalConstructor()->getMock();
            $this->logger = $this->getMockBuilder(ErrorLogger::class)->disableOriginalConstructor()->getMock();
            $this->parameterObject = $this->getMockBuilder(AddressParameterObject::class)
                ->disableOriginalConstructor()
                ->getMock();
            $this->dataGateway = new AddressTableDataGateway($this->pdo, $this->logger);
            $this->exception = new \PDOException();
        }

        public function testPdoExceptionIsLoggedAndRethrownIfGetAllAddressesFails()
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

        public function testPdoExceptionIsLoggedAndRethrownIfGetAllAddressesOrderedByUpdatedFails()
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

            $this->dataGateway->getAllAddressesOrderedByUpdated('ASC');
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
                ->with('Fehler beim lesen der Address Tabelle mit Id: 9999', $this->exception);

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

            $this->dataGateway->update($this->parameterObject);
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
                ->with('Fehler beim löschen eines Datensatzes der Adress Tabelle mit der Id: 9999', $this->exception);

            $this->dataGateway->delete(9999);
        }
    }
}
