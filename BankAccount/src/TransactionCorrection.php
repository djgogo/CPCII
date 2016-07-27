<?php
declare(strict_types = 1);

class TransactionCorrection extends Transaction
{
    /**
     * @var Transaction
     */
    private $reversedTransaction;

    public function __construct(
        Money $money,
        Account $sender,
        Account $receiver,
        \DateTimeImmutable $accountingDate,
        \DateTimeImmutable $valueDate,
        CurrencyConverter $converter,
        Transaction $reversedTransaction)
    {
        parent::__construct($money, $sender, $receiver, $accountingDate, $valueDate, $converter);
        $this->reversedTransaction = $reversedTransaction;
    }

    public function getReversedTransaction() : Transaction
    {
        return $this->reversedTransaction;
    }
}
