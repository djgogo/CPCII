<?php
declare(strict_types = 1);

namespace BankAccount\Currencies
{
    class EUR implements Currency
    {
        public function getCurrencyCode() : string
        {
            return 'EUR';
        }

        public function getDefaultFractionDigits() : int
        {
            return 2;
        }

        public function getDisplayName() : string
        {
            return 'Euro';
        }

        public function getSign() : string
        {
            return '€';
        }

        public function getSubUnit() : int
        {
            return 100;
        }

        public function __toString() : string
        {
            return $this->getCurrencyCode();
        }
    }
}
