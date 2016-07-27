<?php
declare(strict_types = 1);

class USD extends Money
{
    public function __construct(int $amount)
    {
        parent::__construct($amount, new Currency('USD'));
    }
}
