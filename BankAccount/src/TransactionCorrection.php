<?php
declare(strict_types = 1);

namespace BankAccount {

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
            Transaction $reversedTransaction
        )
        {
            parent::__construct($money, $sender, $receiver, $accountingDate, $valueDate);
            $this->reversedTransaction = $reversedTransaction;
        }

        public function getReversedTransaction() : Transaction
        {
            return $this->reversedTransaction;
        }
    }
}
