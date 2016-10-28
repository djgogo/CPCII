<?php
declare(strict_types = 1);

/**
 * @covers ShoppingCartController
 * @uses ShoppingCartRepositoryInterface
 * @uses RequestInterface
 * @uses ResponseInterface
 */
class ShoppingCartControllerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ShoppingCartRepositoryInterface
     */
    private $repository;

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var ResponseInterface
     */
    private $response;

    /**
     * @var ShoppingCart
     */
    private $cart;

    /**
     * @var ShoppingCartController
     */
    private $shoppingCartController;

    public function setUp()
    {
        $this->repository = $this->getMockBuilder(ShoppingCartRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->request = $this->getMockBuilder(RequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->response = $this->getMockBuilder(ResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->cart = $this->getMockBuilder(ShoppingCart::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->shoppingCartController = new ShoppingCartController($this->repository);
    }

    public function testShoppingCartCanBeExecuted()
    {
        $items = [];
        $customerId = 99;

        $this->request->expects($this->once())
            ->method('get')
            ->with('customer_id')
            ->willReturn($customerId);

        $this->repository->expects($this->once())
            ->method('getCartByCustomerId')
            ->with($customerId)
            ->willReturn($this->cart);

        $this->response->expects($this->exactly(2))
            ->method('set')
            ->withConsecutive(
                array('items', $items),
                array('total', 0)
            );

        $this->shoppingCartController->execute($this->request, $this->response);
    }
}

