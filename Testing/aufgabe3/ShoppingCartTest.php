<?php
declare(strict_types = 1);

/**
 * @covers ShoppingCart
 * @uses ShoppingCartItemInterface
 */
class ShoppingCartTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ShoppingCart
     */
    private $shoppingCart;

    /**
     * @var ShoppingCartItemInterface
     */
    private $item1;

    /**
     * @var ShoppingCartItemInterface
     */
    private $item2;

    public function setUp()
    {
        $this->shoppingCart = new ShoppingCart();
        $this->item1 = $this->getMockBuilder(ShoppingCartItemInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->item2 = $this->getMockBuilder(ShoppingCartItemInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testItemsCanBeRetrieved()
    {
        $this->shoppingCart->addItem($this->item1);
        $this->shoppingCart->addItem($this->item2);
        $this->assertContains($this->item1, $this->shoppingCart->getItems());
        $this->assertContains($this->item2, $this->shoppingCart->getItems());
    }

    public function testItemCanBeRemoved()
    {
        $this->shoppingCart->addItem($this->item1);
        $this->shoppingCart->addItem($this->item2);
        $this->shoppingCart->removeItem($this->item1);
        $this->assertNotContains($this->item1, $this->shoppingCart->getItems());
        $this->assertCount(1, $this->shoppingCart->getItems());
    }

    public function testTotalCanBeRetrieved()
    {
        $this->shoppingCart->addItem($this->item1);
        $this->shoppingCart->addItem($this->item2);

        $this->item1->expects($this->once())
            ->method('getPrice')
            ->willReturn(99);
        $this->item2->expects($this->once())
            ->method('getPrice')
            ->willReturn(1);

        $this->assertEquals(100, $this->shoppingCart->getTotal());
    }
}

