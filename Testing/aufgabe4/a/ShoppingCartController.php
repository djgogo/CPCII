<?php

class ShoppingCartController implements ControllerInterface
{
    /**
     * @var ShoppingCartRepositoryInterface
     */
    private $repository;

    public function __construct(ShoppingCartRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    
    public function execute(RequestInterface $request, ResponseInterface $response)
    {
        $customerId = $request->get('customer_id');
        $cart = $this->repository->getCartByCustomerId($customerId);

        $response->set('items', $cart->getItems());
        $response->set('total', $cart->getTotal());

        return 'ShoppingCartListView';
    }
}

