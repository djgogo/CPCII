<?php
declare(strict_types = 1);

namespace BankAccount\Handlers
{
    use BankAccount\Account;
    use BankAccount\CurrencyConverter;
    use BankAccount\Money;
    use BankAccount\Transaction;

    class TransactionHandler
    {
        /**
         * @var Money
         */
        private $money;

        /**
         * @var Account
         */
        private $sender;

        /**
         * @var Account
         */
        private $receiver;

        /**
         * @var \DateTimeImmutable
         */
        private $accountingDate;

        /**
         * @var \DateTimeImmutable
         */
        private $valueDate;

        /**
         * @var CurrencyConverter
         */
        private $converter;

        /**
         * @var Transaction
         */
        private $transaction;

        public function __construct(
            Money $money,
            Account $sender,
            Account $receiver,
            \DateTimeImmutable $accountingDate,
            \DateTimeImmutable $valueDate,
            CurrencyConverter $converter)
        {
            $this->money = $money;
            $this->sender = $sender;
            $this->receiver = $receiver;
            $this->accountingDate = $accountingDate;
            $this->valueDate = $valueDate;
            $this->converter = $converter;
        }

        public function execute()
        {
            if (!$this->receiverAccountEqualSenderAmountCurrency()) {
                $this->money = $this->convertMoney();
            }

            $this->transaction = new Transaction(
                $this->money,
                $this->sender,
                $this->receiver,
                $this->accountingDate,
                $this->valueDate
            );

            $this->transaction->execute();
        }

        private function receiverAccountEqualSenderAmountCurrency() : bool
        {
            return (string) $this->money->getCurrency() === (string) $this->receiver->getCurrency();
        }

        private function convertMoney() : Money
        {
            return $this->converter->convert(
                $this->sender->getCurrency(),
                $this->receiver->getCurrency(),
                $this->money->getAmount()
            );
        }

        public function getTransaction() : Transaction
        {
            return $this->transaction;
        }
    }
}
