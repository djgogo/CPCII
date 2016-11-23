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

        /**
         * @param string $email
         */
        public function __construct(string $email)
        {
            $this->ensureValid($email);

            $this->email = $email;
        }

        // Die Docblöcke kannst du dir sparen wenn du type annotations verwendest.
        /**
         * @param string $email
         */
        private function ensureValid(string $email)
        {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new InvalidEmailException;
            }
        }

        /**
         * @return string
         */
        function __toString() : string
        {
            return $this->email;
        }
    }
}
