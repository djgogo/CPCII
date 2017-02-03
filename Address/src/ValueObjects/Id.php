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
            $this->id = $id;
        }

        private function ensureIdNumberIsBiggerThanZero(int $id)
        {
            if ($id < 0) {
                throw new \InvalidArgumentException('Id: "' . $id . '" was lower than zero.');
            }
        }

        public function __toString(): string
        {
            return (string) $this->id;
        }
    }
}
