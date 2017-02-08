<?php

namespace Address\Http {

    use Address\Entities\Address;

    class Response
    {
        /** @var string */
        private $redirect;

        /** @var array */
        private $addresses;

        /** @var Address */
        private $address;

        public function setRedirect(string $path)
        {
            $this->redirect = $path;
        }

        public function getRedirect(): string
        {
            return $this->redirect;
        }

        public function hasRedirect(): bool
        {
            return isset($this->redirect);
        }

        public function setAddress(Address $address)
        {
            $this->address = $address;
        }

        public function getAddress(): Address
        {
            return $this->address;
        }

        public function setAddresses(Address ...$addresses)
        {
            $this->addresses = $addresses;
        }

        public function getAddresses(): array
        {
            return $this->addresses;
        }
    }
}
