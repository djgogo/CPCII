<?php

namespace Adddress\Entities {

    class Address
    {
        /** @var int */
        private $id;

        /** @var string */
        private $address1;

        /** @var string */
        private $address2;

        /** @var string */
        private $city;

        /** @var int */
        private $postal_code;

        /** @var string */
        private $created_at;

        /** @var string */
        private $updated_at;

        public function getId(): int
        {
            return $this->id;
        }

        public function getAddress1(): string
        {
            return $this->address1;
        }

        public function getAddress2(): string
        {
            return $this->address2;
        }

        public function getCity(): string
        {
            return $this->city;
        }

        public function getPostalCode(): int
        {
            return $this->postal_code;
        }

        public function getCreatedAt(): string
        {
            return $this->created_at;
        }

        public function getUpdatedAt(): string
        {
            return $this->updated_at;
        }
    }
}
