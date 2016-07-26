<?php
declare(strict_types = 1);
require_once __DIR__ . '/bootstrap.php';

$eur = new Currency('EUR');
$usd = new Currency('USD');

$accountPeter = new Account('Peter', 123456, $eur);
$accountAnna = new Account('Anna', 234567, $eur);
$accountSteven = new Account('Steven', 584938, $usd);
$accountValerie = new Account('Valerie', 345334, $usd);

$eur10050 = new Money(100.50, $eur);
$eur9950 = new Money(99.50, $eur);
$eur1080 = new Money(10.80, $eur);
$usd1000 = new Money(10.00, $usd);
$usd2000 = new Money(20.00, $usd);

/* Transactions in EUR */
$transaction1 = new Transaction($eur10050, $accountPeter, $accountAnna);
printf("\nTransaction of %.2f from %s to %s", $transaction1->getAmount(), $accountPeter, $accountAnna);
$transaction2 = new Transaction($eur9950, $accountPeter, $accountAnna);
printf("\nTransaction of %.2f from %s to %s", $transaction2->getAmount(), $accountPeter, $accountAnna);
$transaction3 = new Transaction($eur1080, $accountAnna, $accountPeter);
printf("\nTransaction of %.2f from %s to %s", $transaction3->getAmount(), $accountAnna, $accountPeter);

/* Transactions in USD */
$transaction4 = new Transaction($usd1000, $accountSteven, $accountValerie);
printf("\nTransaction of %.2f from %s to %s\n", $transaction4->getAmount(), $accountSteven, $accountValerie);

/* Transaction from EUR to USD Account - Error! */
try {
    $transaction5 = new Transaction($eur10050, $accountPeter, $accountSteven);
} catch (InvalidTransactionException $e) {
    printf("\n **> Currency of the receiver Account needs to be the same as the sender Account\n");
}

/* Transaction with an amount in USD from EUR to EUR Account - Error! */
try {
    $transaction6 = new Transaction($usd1000, $accountPeter, $accountAnna);
} catch (InvalidTransactionException $e) {
    printf("\n **> Receivers Account-Currency needs to be the same as the senders Transaction Amount-Currency\n");
}

printf("\n%s Account-Balance: %.2f", $accountPeter, $accountPeter->getBalance());
printf("\n%s Account-Balance: %.2f", $accountAnna, $accountAnna->getBalance());
printf("\n%s Account-Balance: %.2f", $accountSteven, $accountSteven->getBalance());
printf("\n%s Account-Balance: %.2f\n", $accountValerie, $accountValerie->getBalance());
