<?php

namespace Address\ValueObjects
{
    class Token
    {
        /** @var null|string */
        private $tokenValue = '';

        public function __construct($value = null)
        {
            if ($value !== null) {
                $this->tokenValue = $value;
            } else {
                $this->setValue();
            }
        }

        private function setValue()
        {
            $source = uniqid(mt_rand(0, PHP_INT_MAX), true);
            $this->tokenValue = sha1(hash('sha512', $source, true));
        }

        public function isEqualTo(Token $token): bool
        {
            return $this->tokenValue === (string)$token;
        }

        public function __toString(): string
        {
            return $this->tokenValue;
        }
    }
}
