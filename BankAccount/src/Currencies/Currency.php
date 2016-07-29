<?php
declare(strict_types = 1);

namespace BankAccount\Currencies
{
    abstract class Currency
    {
        abstract public function getCurrencyCode() : string;

        abstract public function getDefaultFractionDigits() : int;

        abstract public function getDisplayName() : string;

        abstract public function getSign() : string;

        abstract public function getSubUnit() : int;

        abstract public function __toString() : string;

    }
}
