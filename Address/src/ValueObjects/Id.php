<?php

namespace Address\ValueObjects
{
    class Id
    {
        /** @var int */
        private $id;

        public function __construct(int $id)
        {
            $this->ensureIdNumberIsBiggerThanZero($id);
            $this->ensureIdIsIntegral($id);
            $this->ensureIdIsOnlyDigits($id);

            $this->id = $id;
        }

        private function ensureIdNumberIsBiggerThanZero(int $id)
        {
            if ($id < 0) {
                throw new \InvalidArgumentException('Id: "' . $id . '" was lower than zero.');
            }
        }

        private function ensureIdIsIntegral(int $id)
        {
            if ($id === round($id, 0)) {
                throw new \InvalidArgumentException('Id: "' . $id . '" was not Integral.');
            }
        }

        private function ensureIdIsOnlyDigits(int $id)
        {
            if (!ctype_digit((string) $id)) {
                throw new \InvalidArgumentException('Id should have only digits: ' . $id);
            }
        }

        public function __toString(): string
        {
            return (string) $this->id;
        }
    }
}
