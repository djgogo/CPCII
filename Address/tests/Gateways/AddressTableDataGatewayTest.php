<?php

namespace Address\Gateways {

    use Address\Entities\Address;
    use Address\Exceptions\AddressTableGatewayException;
    use Address\Loggers\ErrorLogger;
    use Address\ParameterObjects\AddressParameterObject;

    /**
     * @covers Address\Gateways\AddressTableDataGateway
     * @uses Address\Loggers\ErrorLogger
     * @uses Address\Entities\Address
     * @uses Address\ParameterObjects\AddressParameterObject
     */
    class AddressTableDataGatewayTest extends \PHPUnit_Framework_TestCase
    {
        /** @var \PDO */
        private $pdo;

        /** @var AddressTableDataGateway */
        private $gateway;

        /** @var ErrorLogger | \PHPUnit_Framework_MockObject_MockObject */
        private $logger;

        protected function setUp()
        {
            $this->logger = $this->getMockBuilder(ErrorLogger::class)->disableOriginalConstructor()->getMock();
            $this->pdo = $this->initDatabase();
            $this->gateway = new AddressTableDataGateway($this->pdo, $this->logger);
        }

        public function testAllAddressesCanBeRetrieved()
        {
            $addresses = $this->gateway->getAllAddresses();
            $this->assertInstanceOf(Address::class, $addresses[0]);
            $this->assertEquals('Obi-Van Kenobi', $addresses[0]->getAddress1());
        }

        public function testSearchedAddressCanBeFound()
        {
            $addresses = $this->gateway->getSearchedAddress('Obi-Van Kenobi');
            $this->assertEquals('Obi-Van Kenobi', $addresses[0]->getAddress1());
        }

        public function testAddressCanBeFoundById()
        {
            $address = $this->gateway->findAddressById(1);
            $this->assertEquals(1, $address->getId());
        }

        public function testAddressesCanBeSortedAscendingByUpdated()
        {
            $addresses = $this->gateway->getAllAddressesOrderedByUpdated('ASC');
            $this->assertEquals(1, $addresses[0]->getId());
        }

        public function testAddressesCanBeSortedDescendingByUpdated()
        {
            $addresses = $this->gateway->getAllAddressesOrderedByUpdated('DESC');
            $this->assertEquals(2, $addresses[0]->getId());
        }

        public function testAddressCanBeUpdated()
        {
            $requestFormValues = new AddressParameterObject(
                1,
                'changed Name',
                'changed address',
                'Galaxy',
                1234,
                date("Y-m-d H:i:s")
            );
            $this->gateway->update($requestFormValues);

            $address = $this->gateway->findAddressById(1);
            $this->assertEquals('changed Name', $address->getAddress1());
            $this->assertEquals('changed address', $address->getAddress2());
        }

        public function testAddressCanBeDeleted()
        {
            $this->assertTrue($this->gateway->delete(2));
            
            $this->expectException(AddressTableGatewayException::class);
            $this->gateway->findAddressById(2);
        }

        private function initDatabase()
        {
            $pdo = new \PDO('sqlite::memory:');
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $pdo->query(
                'CREATE TABLE addresses (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                address1 VARCHAR(255) NOT NULL,
                address2 VARCHAR(255) NOT NULL,
                city VARCHAR(255) NOT NULL,
                postalCode INT(11) NOT NULL,
                created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                updated TIMESTAMP NOT NULL)'
            );

            // Insert First Row
            $address11 = 'Obi-Van Kenobi';
            $address21 = 'Milky Way';
            $city1 = 'Galaxy';
            $postalCode1 = 1234;
            $created1 = date("Y-m-d H:i:s");
            $updated1 = '2017-01-26 12:00:00';


            $stmt = $pdo->prepare(
                'INSERT INTO addresses (address1, address2, city, postalCode, created, updated) 
                VALUES (:address1, :address2, :city, :postalCode, :created, :updated)'
            );

            $stmt->bindParam(':address1', $address11, \PDO::PARAM_STR);
            $stmt->bindParam(':address2', $address21, \PDO::PARAM_STR);
            $stmt->bindParam(':city', $city1, \PDO::PARAM_STR);
            $stmt->bindParam(':postalCode', $postalCode1, \PDO::PARAM_INT);
            $stmt->bindParam(':created', $created1, \PDO::PARAM_STR);
            $stmt->bindParam(':updated', $updated1, \PDO::PARAM_STR);
            $stmt->execute();

            // Insert Second Row
            $address12 = 'Luke Skywalker';
            $address22 = 'Mars Ave.';
            $city2 = 'Naboo';
            $postalCode2 = 5678;
            $created2 = date("Y-m-d H:i:s");
            $updated2 = '2017-01-26 18:00:00';

            $stmt = $pdo->prepare(
                'INSERT INTO addresses (address1, address2, city, postalCode, created, updated) 
                VALUES (:address1, :address2, :city, :postalCode, :created, :updated)'
            );

            $stmt->bindParam(':address1', $address12, \PDO::PARAM_STR);
            $stmt->bindParam(':address2', $address22, \PDO::PARAM_STR);
            $stmt->bindParam(':city', $city2, \PDO::PARAM_STR);
            $stmt->bindParam(':postalCode', $postalCode2, \PDO::PARAM_INT);
            $stmt->bindParam(':created', $created2, \PDO::PARAM_STR);
            $stmt->bindParam(':updated', $updated2, \PDO::PARAM_STR);
            $stmt->execute();

            $query = $pdo->query('SELECT * FROM addresses');
            $result = $query->fetchAll(\PDO::FETCH_COLUMN);
            if (count($result) != 2) {
                throw new \Exception('Database could not be initialized!');
            }

            return $pdo;
        }
    }
}
