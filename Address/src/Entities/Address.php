<?php

namespace Address\Entities {

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
        private $postalCode;

        /** @var string */
        private $created;

        /** @var string */
        private $updated;

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
            return $this->postalCode;
        }

        public function getCreated(): string
        {
            return $this->created;
        }

        public function getUpdated(): string
        {
            return $this->updated;
        }
    }
}
