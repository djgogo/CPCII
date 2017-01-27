<?php

namespace Address\Gateways {

    use Address\Entities\Text;
    use Address\Loggers\ErrorLogger;

    /**
     * @covers Address\Gateways\TextTableDataGateway
     * @uses Address\Loggers\ErrorLogger
     * @uses Address\Entities\Text
     */
    class TextTableDataGatewayTest extends \PHPUnit_Framework_TestCase
    {
        /** @var \PDO */
        private $pdo;

        /** @var TextTableDataGateway */
        private $gateway;

        /** @var ErrorLogger | \PHPUnit_Framework_MockObject_MockObject */
        private $logger;

        protected function setUp()
        {
            $this->logger = $this->getMockBuilder(ErrorLogger::class)->disableOriginalConstructor()->getMock();
            $this->pdo = $this->initDatabase();
            $this->gateway = new TextTableDataGateway($this->pdo, $this->logger);
        }

        public function testAllTextsCanBeRetrieved()
        {
            $texts = $this->gateway->getAllTexts();
            $this->assertInstanceOf(Text::class, $texts[0]);
            $this->assertEquals('Lorem ipsum dolor', $texts[0]->getText1());
        }

        public function testSearchedTextCanBeFound()
        {
            $texts = $this->gateway->getSearchedText('Lorem ipsum dolor');
            $this->assertEquals('Lorem ipsum dolor', $texts[0]->getText1());
        }

        public function testTextCanBeFoundById()
        {
            $text = $this->gateway->findTextById(1);
            $this->assertEquals(1, $text->getId());
        }

        public function testTextsCanBeSortedAscendingByUpdated()
        {
            $texts = $this->gateway->getAllTextsOrderedByUpdatedAscending();
            $this->assertEquals(1, $texts[0]->getId());
        }

        public function testTextsCanBeSortedDescendingByUpdated()
        {
            $texts = $this->gateway->getAllTextsOrderedByUpdatedDescending();
            $this->assertEquals(2, $texts[0]->getId());
        }

        public function testAddressCanBeUpdated()
        {
            $row = [
                'id' => 1,
                'text1' => 'changed text1',
                'text2' => 'changed text2',
                'updated' => date("Y-m-d H:i:s")
            ];
            $this->assertTrue($this->gateway->update($row));

            $address = $this->gateway->findTextById(1);
            $this->assertEquals('changed text1', $address->getText1());
            $this->assertEquals('changed text2', $address->getText2());
        }

        private function initDatabase()
        {
            $pdo = new \PDO('sqlite::memory:');
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $pdo->query(
                'CREATE TABLE texts (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                text1 VARCHAR(255) NOT NULL,
                text2 VARCHAR(255) NOT NULL,
                created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                updated TIMESTAMP NOT NULL)'
            );

            // Insert First Row
            $text11 = 'Lorem ipsum dolor';
            $text21 = 'Lorem ipsum dolor sit amet';
            $created1 = date("Y-m-d H:i:s");
            $updated1 = '2017-01-26 12:00:00';


            $stmt = $pdo->prepare(
                'INSERT INTO texts (text1, text2, created, updated) 
                VALUES (:text1, :text2, :created, :updated)'
            );

            $stmt->bindParam(':text1', $text11, \PDO::PARAM_STR);
            $stmt->bindParam(':text2', $text21, \PDO::PARAM_STR);
            $stmt->bindParam(':created', $created1, \PDO::PARAM_STR);
            $stmt->bindParam(':updated', $updated1, \PDO::PARAM_STR);
            $stmt->execute();

            // Insert Second Row
            $text12 = 'Test Text1';
            $text22 = 'Test Text2';
            $created2 = date("Y-m-d H:i:s");
            $updated2 = '2017-01-26 18:00:00';

            $stmt = $pdo->prepare(
                'INSERT INTO texts (text1, text2, created, updated) 
                VALUES (:text1, :text2, :created, :updated)'
            );


            $stmt->bindParam(':text1', $text12, \PDO::PARAM_STR);
            $stmt->bindParam(':text2', $text22, \PDO::PARAM_STR);
            $stmt->bindParam(':created', $created2, \PDO::PARAM_STR);
            $stmt->bindParam(':updated', $updated2, \PDO::PARAM_STR);
            $stmt->execute();

            $query = $pdo->query('SELECT * FROM texts');
            $result = $query->fetchAll(\PDO::FETCH_COLUMN);
            if (count($result) != 2) {
                throw new \Exception('Database could not be initialized!');
            }

            return $pdo;
        }
    }
}
