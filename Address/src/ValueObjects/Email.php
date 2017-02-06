<?php

namespace Address\ValueObjects
{
    use Address\Exceptions\InvalidEmailException;

    class Email
    {
        /** @var string */
        private $email;

        public function __construct(string $email)
        {
            $this->ensureIsValid($email);
            $this->email = $email;
        }

        private function ensureIsValid(string $email)
        {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new InvalidEmailException;
            }
        }

        function __toString(): string
        {
            return $this->email;
        }
    }
}
