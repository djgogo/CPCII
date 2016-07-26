<?php
declare(strict_types = 1);

class Transaction
{
    /**
     * @var Account
     */
    private $sender;

    /**
     * @var Account
     */
    private $receiver;

    /**
     * @var Money
     */
    private $money;

    /**
     * @var DateTimeImmutable
     */
    private $accountingDate;

    public function __construct(Money $money, Account $sender, Account $receiver, \DateTimeImmutable $accountingDate)
    {
        $this->sender = $sender;
        $this->receiver = $receiver;
        $this->money = $money;
        $this->accountingDate = $accountingDate;
        $this->ensureSameAccountCurrency();
        $this->ensureRightTransactionCurrency();
        $this->executeTransaction();
    }

    private function executeTransaction()
    {
        $this->sender->addCredit($this);
        $this->receiver->addDebit($this);
    }

    public function reverse()
    {
        $this->sender->addDebit($this);
        $this->receiver->addCredit($this);
    }

    public function getAmount() : float
    {
        return $this->money->getAmount();
    }

    public function getAccountingDate() : DateTimeImmutable
    {
        return $this->accountingDate;
    }

    public function getFormattedAccountingDate() : string
    {
        return $this->accountingDate->format('Y-m-d');
    }

    private function ensureSameAccountCurrency()
    {
        if ($this->sender->getCurrency() !== $this->receiver->getCurrency()) {
            throw new InvalidTransactionException('Currency of the receiver Account needs to be the same as the sender Account');
        }
    }

    private function ensureRightTransactionCurrency()
    {
        if ($this->money->getCurrency() !== $this->receiver->getCurrency()) {
            throw new InvalidTransactionException('Receivers Account-Currency needs to be the same as the senders Amount-Currency');
        }
    }
}
