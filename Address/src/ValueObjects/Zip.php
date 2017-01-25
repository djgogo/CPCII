<?php

namespace Address\ValueObjects {

    class Zip
    {
        /**
         * @var int
         */
        private $zip;

        /**
         * @param int $zip
         */
        public function __construct($zip)
        {
            $this->setZip($zip);
        }

        /**
         * @param int $zip
         * @throws \InvalidArgumentException
         */
        private function setZip($zip)
        {
            $zip = trim($zip);

            if (strlen($zip) !== 4 || (int) $zip < 1000 || (int) $zip > 9999) {
                throw new \InvalidArgumentException('invalid ZIP Code "' . $zip . '"');
            }

            $this->zip = $zip;
        }

        /**
         * @return string
         */
        public function __toString()
        {
            return (string) $this->zip;
        }
    }
}
