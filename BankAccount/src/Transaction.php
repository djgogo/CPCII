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

    public function __construct(Money $money, Account $sender, Account $receiver)
    {
        $this->sender = $sender;
        $this->receiver = $receiver;
        $this->money = $money;
        $this->executeTransaction();
    }

    private function executeTransaction()
    {
        $this->sender->addCredit($this);
        $this->receiver->addDebit($this);
    }

    public function getAmount() : float
    {
        return $this->money->getAmount();
    }
}
