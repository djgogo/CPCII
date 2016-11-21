<?php

class SuxxProductTableDataGatewayTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var PDO
     */
    private $pdo;

    /**
     * @var SuxxProductTableDataGateway
     */
    private $gateway;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject | \SuxxErrorLogger
     */
    private $logger;

    protected function setUp()
    {
        $this->logger = $this->getMockBuilder(\SuxxErrorLogger::class)->disableOriginalConstructor()->getMock();
        $this->pdo = $this->initDatabase();
        $this->gateway = new SuxxProductTableDataGateway($this->pdo, $this->logger);
    }

    public function testAllProductsCanBeRetrieved()
    {
        $products = $this->gateway->getAllProducts();
        $this->assertInstanceOf(SuxxProduct::class, $products[0]);
        $this->assertEquals('Produkt1', $products[0]->getLabel());
    }

    public function testSearchedProductCanBeFound()
    {
        $products = $this->gateway->getSearchedProduct('Produkt1');
        $this->assertEquals('Produkt1', $products[0]->getLabel());
    }

    public function testProductCanBeFoundById()
    {
        $product = $this->gateway->findProductById(1);
        $this->assertEquals(1, $product->getPid());
    }

    public function testProductsCanBeSortedAscendingByUpdated()
    {
        $products = $this->gateway->getAllProductsOrderedByUpdatedAscending();
        $this->assertEquals(1, $products[0]->getPid());
    }

    public function testProductsCanBeSortedDescendingByUpdated()
    {
        $products = $this->gateway->getAllProductsOrderedByUpdatedDescending();
        $this->assertEquals(2, $products[0]->getPid());
    }

    public function testProductCanBeUpdated()
    {
        $row = [
            'pid' => 1,
            'label' => 'changed product',
            'price' => 200
        ];
        $this->assertTrue($this->gateway->update($row));

        $product = $this->gateway->findProductById(1);
        $this->assertEquals('changed product', $product->getLabel());
        $this->assertEquals(200, $product->getPrice());
    }

    private function initDatabase()
    {
        $pdo = new \PDO('sqlite::memory:');
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $pdo->query(
            'CREATE TABLE products (
                pid INTEGER PRIMARY KEY AUTOINCREMENT,
                label varchar(200) NOT NULL,
                img varchar(200) NOT NULL,
                price int(11) NOT NULL,
                created datetime NOT NULL,
                updated timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
            )'
        );

        // Insert First Row
        $label1 = 'Produkt1';
        $image1 = 'Produkt1.jpg';
        $price1 = 120;
        $created1 = date("Y-m-d H:i:s");
        $updated1 = '2016-11-01 12:00:00';

        $stmt = $pdo->prepare(
            'INSERT INTO products (label, img, price, created, updated) 
                VALUES (:label, :img, :price, :created, :updated)'
        );

        $stmt->bindParam(':label', $label1, PDO::PARAM_STR);
        $stmt->bindParam(':img', $image1, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price1, PDO::PARAM_INT);
        $stmt->bindParam(':created', $created1, PDO::PARAM_STR);
        $stmt->bindParam(':updated', $updated1, PDO::PARAM_STR);
        $stmt->execute();

        // Insert Second Row
        $label2 = 'Produkt2';
        $image2 = 'Produkt2.jpg';
        $price2 = 500;
        $created2 = date("Y-m-d H:i:s");
        $updated2 = '2016-11-11 18:00:00';

        $stmt = $pdo->prepare(
            'INSERT INTO products (label, img, price, created, updated) 
                VALUES (:label, :img, :price, :created, :updated)'
        );

        $stmt->bindParam(':label', $label2, PDO::PARAM_STR);
        $stmt->bindParam(':img', $image2, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price2, PDO::PARAM_INT);
        $stmt->bindParam(':created', $created2, PDO::PARAM_STR);
        $stmt->bindParam(':updated', $updated2, PDO::PARAM_STR);
        $stmt->execute();

        $query = $pdo->query('SELECT * FROM products');
        $result = $query->fetchAll(PDO::FETCH_COLUMN);

        if (count($result) != 2) {
            var_dump('Database could not be initialized!');
        }

        return $pdo;
    }
}
