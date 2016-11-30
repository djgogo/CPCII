<?php

namespace Suxx\ValueObjects
{
    use Suxx\Exceptions\InvalidEmailException;

    class Email
    {
        /**
         * @var string
         */
        private $email;

        public function __construct(string $email)
        {
            $this->ensureValid($email);

            $this->email = $email;
        }

        private function ensureValid(string $email)
        {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new InvalidEmailException;
            }
        }

        function __toString() : string
        {
            return $this->email;
        }
    }
}
