<?php

namespace Address\ValueObjects
{
    class Username
    {
        /** @var string */
        private $username;

        public function __construct(string $username)
        {
            $this->ensureUsernameIsValid($username);
            $this->username = $username;
        }

        private function ensureUsernameIsValid(string $username)
        {
            if (strlen($username) > 50) {
                throw new \InvalidArgumentException('Username: "' . $username . '" is longer than 50 char.');
            }
        }

        public function __toString(): string
        {
            return (string) $this->username;
        }
    }
}
