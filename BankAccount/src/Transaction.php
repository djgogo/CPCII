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
     * @var float
     */
    private $amount;

    public function __construct(float $amount, Account $sender, Account $receiver)
    {
        $this->sender = $sender;
        $this->receiver = $receiver;
        $this->amount = $amount;
        $this->executeTransaction();
    }

    private function executeTransaction()
    {
        $this->sender->addCredit($this);
        $this->receiver->addDebit($this);
    }

    public function getAmount() : float
    {
        return $this->amount;
    }
}
