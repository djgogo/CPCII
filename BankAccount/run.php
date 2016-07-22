<?php
declare(strict_types = 1);
require_once __DIR__ . '/bootstrap.php';

$accountPeter = new Account('Peter', 123456);
$accountAnna = new Account('Anna', 234567);

$transaction1 = new Transaction(100.50, $accountPeter, $accountAnna);
printf("\nTransaction of %.2f from %s to %s created\n", $transaction1->getAmount(), $accountPeter, $accountAnna);

$transaction2 = new Transaction(99.50, $accountPeter, $accountAnna);
printf("\nTransaction of %.2f from %s to %s created\n", $transaction2->getAmount(), $accountPeter, $accountAnna);

$transaction3 = new Transaction(10.80, $accountAnna, $accountPeter);
printf("\nTransaction of %.2f from %s to %s created\n", $transaction3->getAmount(), $accountAnna, $accountPeter);

printf("\n%s Account-Balance: %.2f \n", $accountPeter, $accountPeter->getBalance());
printf("\n%s Account-Balance: %.2f \n", $accountAnna, $accountAnna->getBalance());
