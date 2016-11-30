<?php

namespace Suxx\Integration {

    use Suxx\Exceptions\ProductTableGatewayException;
    use Suxx\Gateways\ProductTableDataGateway;
    use Suxx\Loggers\ErrorLogger;

    /**
     * @covers Suxx\Gateways\ProductTableDataGateway
     * @uses   Suxx\Loggers\ErrorLogger
     */
    class ProductPersistenceIntegrationTest extends \PHPUnit_Framework_TestCase
    {
        /**
         * @var \PHPUnit_Framework_MockObject_MockObject | \PDO
         */
        private $pdo;

        /**
         * @var ProductTableDataGateway
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
            $this->gateway = new ProductTableDataGateway($this->pdo, $this->logger);
        }

        public function testIfProductTableCouldNotBeReadThrowsExceptionAndWillBeLogged()
        {
            $this->expectException(ProductTableGatewayException::class);

            $this->pdo
                ->expects($this->once())
                ->method('prepare')
                ->will($this->throwException($this->e));

            $this->logger
                ->expects($this->once())
                ->method('log')
                ->with('Fehler beim lesen der Produkt Tabelle.', $this->e);

            $this->gateway->getAllProducts();
        }

        public function testIfProductTableOrderedByAscendingCouldNotBeReadThrowsExceptionAndWillBeLogged()
        {
            $this->expectException(ProductTableGatewayException::class);

            $this->pdo
                ->expects($this->once())
                ->method('prepare')
                ->will($this->throwException($this->e));

            $this->logger
                ->expects($this->once())
                ->method('log')
                ->with('Fehler beim lesen der Produkt Tabelle.', $this->e);

            $this->gateway->getAllProductsOrderedByUpdatedAscending();
        }

        public function testIfProductTableOrderedByDescendingCouldNotBeReadThrowsExceptionAndWillBeLogged()
        {
            $this->expectException(ProductTableGatewayException::class);

            $this->pdo
                ->expects($this->once())
                ->method('prepare')
                ->will($this->throwException($this->e));

            $this->logger
                ->expects($this->once())
                ->method('log')
                ->with('Fehler beim lesen der Produkt Tabelle.', $this->e);

            $this->gateway->getAllProductsOrderedByUpdatedDescending();
        }

        public function testIfProductSearchCouldNotBeReadThrowsExceptionAndWillBeLogged()
        {
            $this->expectException(ProductTableGatewayException::class);

            $this->pdo
                ->expects($this->once())
                ->method('prepare')
                ->will($this->throwException($this->e));

            $this->logger
                ->expects($this->once())
                ->method('log')
                ->with('Fehler beim lesen der Produkt Tabelle.', $this->e);

            $this->gateway->getSearchedProduct('searchString');
        }

        public function testIfProductFoundByIdCouldNotBeReadThrowsExceptionAndWillBeLogged()
        {
            $this->expectException(ProductTableGatewayException::class);

            $this->pdo
                ->expects($this->once())
                ->method('prepare')
                ->will($this->throwException($this->e));

            $this->logger
                ->expects($this->once())
                ->method('log')
                ->with('Fehler beim lesen der Produkt Tabelle.', $this->e);

            $this->gateway->findProductById(0);
        }

        public function testIfProductCouldNotBeUpdatedThrowsExceptionAndWillBeLogged()
        {
            $this->expectException(ProductTableGatewayException::class);

            $this->pdo
                ->expects($this->once())
                ->method('prepare')
                ->will($this->throwException($this->e));

            $this->logger
                ->expects($this->once())
                ->method('log')
                ->with('Fehler beim ändern eines Datensatzes der Produkt Tabelle.', $this->e);

            $this->gateway->update(array());
        }
    }
}
