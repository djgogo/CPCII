<?php
declare(strict_types = 1);

interface ShoppingCartItemInterface
{
    public function getName();
    public function getUnitPrice();
    public function getPrice();
    public function getQuantity();
    public function setQuantity($quantity);
    public function incrementQuantity();
    public function decrementQuantity();
}

