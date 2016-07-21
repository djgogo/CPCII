<?php
declare(strict_types = 1);

interface AccountInterface
{
    public function addCredit(Transaction $transaction);
    public function addDebit(Transaction $transaction);
    public function getBalance();
}
