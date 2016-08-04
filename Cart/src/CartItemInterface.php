<?php
declare(strict_types = 1);

namespace Cart
{
    interface CartItemInterface
    {
        public function getName();
        public function getPrice();
        public function setPrice(Money $money);
        public function getUnitPrice();
        public function getQuantity();
        public function setQuantity(int $quantity);
    }
}
