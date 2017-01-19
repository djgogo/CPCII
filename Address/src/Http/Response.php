<?php

namespace Address\Http {

    use Adddress\Entities\Address;
    use Address\Exceptions\ResponseException;

    class Response
    {
        /** @var array */
        private $data = array();

        /** @var string */
        private $redirect;

        /** @var array */
        private $addresses;

        /** @var Address */
        private $address;

        public function setValue($key, $value)
        {
            $this->data[$key] = $value;
        }

        public function getValue(string $key): string
        {
            if (!isset($this->data[$key])) {
                throw new ResponseException("Key '$key' does not exist");
            }
            return $this->data[$key];
        }

        public function isset(string $key): bool
        {
            return isset($this->data[$key]);
        }

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

        public function setAddresses(array $addresses)
        {
            $this->addresses = $addresses;
        }

        public function getAddresses(): array
        {
            return $this->addresses;
        }
    }
}
