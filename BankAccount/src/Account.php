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
        $this->credits[] = [$transaction->getAccountingDate(), $transaction->getAmount()];
    }

    public function addDebit(Transaction $transaction)
    {
        $this->debits[] = [$transaction->getAccountingDate(), $transaction->getAmount()];
    }

    public function getBalance(DateTimeImmutable $accountingDate = null) : float
    {
        if ($accountingDate === null) {
            $accountingDate = new DateTimeImmutable();
        }

        $debitSum = 0;
        for ($i = 0; $i < count($this->debits); $i++) {
            if ($this->debits[$i][0] <= $accountingDate){
                $debitSum += $this->debits[$i][1];
            }
        }

        $creditSum = 0;
        for ($i = 0; $i < count($this->credits); $i++) {
            if ($this->credits[$i][0] <= $accountingDate) {
                $creditSum += $this->credits[$i][1];
            }
        }

        return $debitSum - $creditSum;
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
