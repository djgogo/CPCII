<?php

namespace Address\ParameterObjects {

    class AddressParameterObject
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
        private $updated;

        public function __construct(int $id, string $address1, string $address2, string $city, int $postalCode, string $updated)
        {
            $this->id = $id;
            $this->address1 = $address1;
            $this->address2 = $address2;
            $this->city = $city;
            $this->postalCode = $postalCode;
            $this->updated = $updated;
        }

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

        public function getUpdated(): string
        {
            return $this->updated;
        }
    }
}
