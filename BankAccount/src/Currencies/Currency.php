<?php
declare(strict_types = 1);

namespace BankAccount\Currencies
{
    interface Currency
    {
        public function getCurrencyCode() : string;

        public function getDefaultFractionDigits() : int;

        public function getDisplayName() : string;

        public function getSign() : string;

        public function getSubUnit() : int;

        public function __toString() : string;
    }
}
