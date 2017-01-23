<?php

namespace Address\Http {

    use Adddress\Entities\Address;
    use Adddress\Entities\Text;

    class Response
    {
        /** @var string */
        private $redirect;

        /** @var array */
        private $addresses;

        /** @var Address */
        private $address;

        /** @var array */
        private $texts;

        /** @var Text */
        private $text;

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

        public function setText(Text $text)
        {
            $this->text = $text;
        }

        public function getText(): Text
        {
            return $this->text;
        }

        public function setTexts(array $texts)
        {
            $this->texts = $texts;
        }

        public function getTexts(): array
        {
            return $this->texts;
        }
    }
}
