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

    public function __construct(string $name, int $accountNumber)
    {
        $this->name = $name;
        $this->accountNumber = $accountNumber;
    }

    //todo money objekt! money->add
    public function addCredit(Transaction $transaction)
    {
       $this->credits[] = $transaction->getAmount();
    }

    //todo money objekt! money->subtract
    public function addDebit(Transaction $transaction)
    {
        $this->debits[] = $transaction->getAmount();
    }

    public function getBalance() : float
    {
        return array_sum($this->debits) - array_sum($this->credits);
    }

    public function __toString() : string
    {
        return $this->name;
    }
}
