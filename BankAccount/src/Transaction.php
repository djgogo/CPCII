<?php
declare(strict_types = 1);

namespace BankAccount {

    class Transaction
    {
        /**
         * @var Account
         */
        private $sender;

        /**
         * @var Account
         */
        protected $receiver;

        /**
         * @var Money
         */
        protected $money;

        /**
         * @var \DateTimeImmutable
         */
        private $accountingDate;

        /**
         * @var \DateTimeImmutable
         */
        private $valueDate;

        public function __construct(
            Money $money,
            Account $sender,
            Account $receiver,
            \DateTimeImmutable $accountingDate,
            \DateTimeImmutable $valueDate
        )
        {
            $this->sender = $sender;
            $this->receiver = $receiver;
            $this->money = $money;
            $this->accountingDate = $accountingDate;
            $this->valueDate = $valueDate;
        }

        public function execute()
        {
            $this->sender->addCredit($this);
            $this->receiver->addDebit($this);
        }

        public function reverse()
        {
            $this->sender->addDebit($this);
            $this->receiver->addCredit($this);
        }

        public function getAmount() : Money
        {
            return $this->money;
        }

        public function getAccountingDate() : \DateTimeImmutable
        {
            return $this->accountingDate;
        }

        public function getValueDate() : \DateTimeImmutable
        {
            return $this->valueDate;
        }

        public function getFormattedAccountingDate() : string
        {
            return $this->accountingDate->format('Y-m-d');
        }
    }
}
