<?php
declare(strict_types = 1);

namespace Cart
{
    class CartItem implements CartItemInterface
    {
        /**
         * @var string
         */
        private $name;

        /**
         * @var Money
         */
        private $price;

        /**
         * @var Money
         */
        private $unitPrice;

        /**
         * @var int
         */
        public $quantity;

        public function __construct(string $name, Money $price, Money $unitPrice, int $quantity)
        {
            $this->name = $name;
            $this->price = $price;
            $this->unitPrice = $unitPrice;
            $this->quantity = $quantity;
        }

        public function getName() : string
        {
           return $this->name;
        }

        public function getPrice() : Money
        {
            return $this->price;
        }

        public function getUnitPrice() : Money
        {
            return $this->unitPrice;
        }

        public function getQuantity() : int
        {
            return $this->quantity;
        }
    }
}
