<?php
declare(strict_types = 1);

namespace Cart
{
    class CartItem implements CartItemInterface
    {
        /**
         * @var int
         */
        private $id;

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
        /**
         * @var int
         */

        public function __construct(int $id, string $name, Money $price, Money $unitPrice, int $quantity)
        {
            $this->name = $name;
            $this->price = $price;
            $this->unitPrice = $unitPrice;
            $this->quantity = $quantity;
            $this->id = $id;
        }

        public function getId() : int
        {
            return $this->id;
        }

        public function getName() : string
        {
           return $this->name;
        }

        public function getPrice() : Money
        {
            return $this->price;
        }

        public function setPrice(Money $newPrice)
        {
            $this->price = $newPrice;
        }

        public function getUnitPrice() : Money
        {
            return $this->unitPrice;
        }

        public function getQuantity() : int
        {
            return $this->quantity;
        }

        public function setQuantity(int $quantity)
        {
            $this->quantity = $quantity;
        }
    }
}
