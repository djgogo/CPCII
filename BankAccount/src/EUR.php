<?php
declare(strict_types = 1);

class EUR extends Money
{
    public function __construct(int $amount)
    {
        parent::__construct($amount, new Currency('EUR'));
    }
}
