<?php
declare(strict_types = 1);

namespace BankAccount {

    interface AccountInterface
    {
        public function addCredit(Transaction $transaction);

        public function addDebit(Transaction $transaction);

        public function getBalance(\DateTimeImmutable $dateTimeImmutable);
    }

}
