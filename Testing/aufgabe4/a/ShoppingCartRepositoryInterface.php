<?php
declare(strict_types = 1);

interface ShoppingCartRepositoryInterface
{
    public function getCartByCustomerId($customerId) : ShoppingCart;
    public function insert($customerId, ShoppingCart $cart);
    public function update($customerId, ShoppingCart $cart);
    public function delete($customerId);
}

