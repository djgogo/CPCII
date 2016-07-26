<?php
declare(strict_types = 1);

class Account implements AccountInterface
{
    /**
     * @var array
     */
    private $debits = [];

    /**
     * @var array
     */
    private $credits = [];

    /**
     * @var int
     */
    private $accountNumber;

    /**
     * @var string
     */
    private $name;

    /**
     * @var Currency
     */
    private $currency;

    public function __construct(string $name, int $accountNumber, Currency $currency)
    {
        $this->name = $name;
        $this->accountNumber = $accountNumber;
        $this->currency = $currency;
    }

    public function addCredit(Transaction $transaction)
    {
       $this->credits[] = $transaction->getAmount();
    }

    public function addDebit(Transaction $transaction)
    {
        $this->debits[] = $transaction->getAmount();
    }

    public function getBalance() : float
    {
        return array_sum($this->debits) - array_sum($this->credits);
    }

    public function getCurrency() : Currency
    {
        return $this->currency;
    }

    public function __toString() : string
    {
        return $this->name;
    }
}
