<?php
declare(strict_types = 1);

class ShoppingCartGateway1Test extends PHPUnit_Framework_TestCase
{
    /**
     * @var PDOFactory
     */
    private $factory;

    /**
     * @var PDO
     */
    private $db;

    /**
     * @var ShoppingCartGateway
     */
    private $gateway;

    /**
     * @var ShoppingCartItemInterface
     */
    private $item;

    public function setUp()
    {
        $this->factory = new PDOFactory();
        $this->db = $this->factory->getPDO();
        $this->gateway = new ShoppingCartGateway($this->db);
        $this->item = $this->getMockBuilder(ShoppingCartItemInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->initDatabase();
    }

    public function testShoppingCartCanBeRetrievedById()
    {
        // Insert two Shopping Carts
        $id1 = new UUID();
        $cart1 = new ShoppingCart($id1);
        $this->gateway->insert($id1, $cart1);

        $id2 = new UUID();
        $cart2 = new ShoppingCart($id2);
        $this->gateway->insert($id2, $cart2);

        $query = $this->db->query('SELECT * FROM shoppingCart');
        $result = $query->fetchAll(PDO::FETCH_COLUMN);

        $cart = $this->gateway->findById($id1);

        $this->assertEquals(2, count($result));
        $this->assertInstanceOf('ShoppingCart', $cart);
        $this->assertEquals($id1, $cart->getId());
    }

    public function testShoppingCartCanBeInserted()
    {
        // Insert two Shopping Carts
        $id1 = new UUID();
        $cart1 = new ShoppingCart($id1);
        $this->gateway->insert($id1, $cart1);

        $id2 = new UUID();
        $cart2 = new ShoppingCart($id2);
        $this->gateway->insert($id2, $cart2);

        $query = $this->db->query('SELECT * FROM shoppingCart');
        $result = $query->fetchAll(PDO::FETCH_COLUMN);

        $this->assertEquals(2, count($result));
    }

    public function testShoppingCartCanBeUpdated()
    {
        // Insert a Shopping Cart with one Item
        $id1 = new UUID();
        $cart1 = new ShoppingCart($id1);
        $cart1->addItem($this->item);
        $this->gateway->insert($id1, $cart1);

        // Assert that item is added
        $this->assertEquals(1, count($cart1->getItems()));

        // Remove Item and assert
        $cart1->removeItem($this->item);
        $this->assertEquals(0, count($cart1->getItems()));

        // Update Cart Database
        $this->gateway->update($id1, $cart1);

        // Assert that the change has affected the cart in the database
        $cart = $this->gateway->findById($id1);
        $this->assertEquals(0, count($cart->getItems()));
    }

    public function testShoppingCartCanBeDeleted()
    {
        // Insert two Shopping Carts
        $id1 = new UUID();
        $cart1 = new ShoppingCart($id1);
        $this->gateway->insert($id1, $cart1);

        $query = $this->db->query('SELECT * FROM shoppingCart');
        $result = $query->fetchAll(PDO::FETCH_COLUMN);
        $this->assertEquals(1, count($result));

        // Delete Cart from Cart Database
        $this->gateway->delete($id1);

        $query = $this->db->query('SELECT * FROM shoppingCart');
        $result = $query->fetchAll(PDO::FETCH_COLUMN);
        $this->assertEquals(0, count($result));
    }

    private function initDatabase()
    {
        $this->db->query(
            'CREATE TABLE shoppingCart (id CHAR PRIMARY KEY, cart)'
        );
    }
}

