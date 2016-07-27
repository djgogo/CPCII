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
        $this->credits[] = [
            'accountingDate' => $transaction->getAccountingDate(),
            'valueDate' => $transaction->getValueDate(),
            'amount' => $transaction->getAmount()
        ];
    }

    public function addDebit(Transaction $transaction)
    {
        $this->debits[] = [
            'accountingDate' => $transaction->getAccountingDate(),
            'valueDate' => $transaction->getValueDate(),
            'amount' => $transaction->getAmount()
        ];
    }

    public function getBalance(DateTimeImmutable $valueDate = null) : float
    {
        if ($valueDate === null) {
            $valueDate = new DateTimeImmutable();
        }

        $debitSum = 0;
        for ($i = 0; $i < count($this->debits); $i++) {
            if ($this->debits[$i]['valueDate'] <= $valueDate){
                $debitSum += $this->debits[$i]['amount'];
            }
        }

        $creditSum = 0;
        for ($i = 0; $i < count($this->credits); $i++) {
            if ($this->credits[$i]['valueDate'] <= $valueDate) {
                $creditSum += $this->credits[$i]['amount'];
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
