<?php
declare(strict_types = 1);

interface ShoppingCartInterface
{
    public function findById(UUID $id) : ShoppingCart;
    public function insert(UUID $id, ShoppingCart $cart);
    public function update(UUID $id, ShoppingCart $cart);
    public function delete(UUID $id);
}

