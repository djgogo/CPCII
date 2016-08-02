<?php
declare(strict_types = 1);

namespace Cart
{
    class Article implements ArticleInterface
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

        public function __construct(int $id, string $name, Money $price)
        {
            $this->id = $id;
            $this->name = $name;
            $this->price = $price;
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
    }
}
