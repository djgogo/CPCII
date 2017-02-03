<?php

namespace Address\ValueObjects {

    class Zip
    {
        /** @var int */
        private $zip;

        public function __construct(string $zip)
        {
            $this->setZip($zip);
        }

        private function setZip(string $zip)
        {
            $zip = trim($zip);

            if (strlen($zip) !== 4 || (int) $zip < 1000 || (int) $zip > 9999) {
                throw new \InvalidArgumentException('invalid ZIP Code "' . $zip . '"');
            }

            $this->zip = $zip;
        }

        public function __toString(): string
        {
            return (string) $this->zip;
        }
    }
}
