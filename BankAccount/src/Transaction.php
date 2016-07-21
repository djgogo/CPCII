<?php
declare(strict_types = 1);

class Transaction
{
    /**
     * @var Account
     */
    private $debit;
    /**
     * @var Account
     */
    private $credit;
    /**
     * @var float
     */
    private $amount;

    public function __construct(float $amount, Account $debit, Account $credit)
    {
        $this->executeTransaction($amount, $debit, $credit);
        $this->debit = $debit;
        $this->credit = $credit;
        $this->amount = $amount;
    }

    private function executeTransaction($amount, $debit, $credit)
    {

    }


}
