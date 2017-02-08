<?php

namespace Address\ValueObjects
{
    class Password
    {
        /** @var string */
        private $password;

        public function __construct(string $password)
        {
            $this->ensurePasswordIsBigEnough($password);
            $this->ensurePasswordIsNotToBig($password);
            $this->password = $password;
        }

        private function ensurePasswordIsBigEnough(string $password)
        {
            if (strlen($password) < 6) {
                throw new \InvalidArgumentException('Password: "' . $password . '" is not long enough.');
            }
        }

        private function ensurePasswordIsNotToBig(string $password)
        {
            if (strlen($password) > 255) {
                throw new \InvalidArgumentException('Password: "' . $password . '" is too big.');
            }
        }

        public function __toString(): string
        {
            return (string) $this->password;
        }
    }
}
