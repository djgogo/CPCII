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
$eur1000000 = new Money(1000.00, $eur);
$eur9950 = new Money(99.50, $eur);
$eur9050 = new Money(90.50, $eur);
$eur1080 = new Money(10.80, $eur);
$usd1000 = new Money(10.00, $usd);
$usd2000 = new Money(20.00, $usd);

/* Transactions in EUR */
$transaction1 = new Transaction($eur10050, $accountPeter, $accountAnna, new DateTimeImmutable('2016-06-19'));
printf("\n%s : Transaction of %.2f from %s to %s", $transaction1->getFormattedAccountingDate(),
    $transaction1->getAmount(), $accountPeter, $accountAnna);

$transaction2 = new Transaction($eur9950, $accountPeter, $accountAnna, new DateTimeImmutable('2016-06-19'));
printf("\n%s : Transaction of %.2f from %s to %s", $transaction2->getFormattedAccountingDate(),
    $transaction2->getAmount(), $accountPeter, $accountAnna);

$transaction3 = new Transaction($eur1080, $accountAnna, $accountPeter, new DateTimeImmutable('2016-06-25'));
printf("\n%s : Transaction of %.2f from %s to %s", $transaction3->getFormattedAccountingDate(),
    $transaction3->getAmount(), $accountAnna, $accountPeter);

$transaction7 = new Transaction($eur1000000, $accountPeter, $accountAnna, new DateTimeImmutable('2016-06-29'));
printf("\n%s : Transaction of %.2f from %s to %s", $transaction7->getFormattedAccountingDate(),
    $transaction7->getAmount(), $accountPeter, $accountAnna);

/* Transactions in USD */
$transaction4 = new Transaction($usd1000, $accountSteven, $accountValerie, new DateTimeImmutable('2016-06-30'));
printf("\n%s : Transaction of %.2f from %s to %s\n", $transaction4->getFormattedAccountingDate(),
    $transaction4->getAmount(), $accountSteven, $accountValerie);

/* Transaction from EUR to USD Account - Error! */
try {
    $transaction5 = new Transaction($eur10050, $accountPeter, $accountSteven, new DateTimeImmutable('2016-07-10'));
} catch (InvalidTransactionException $e) {
    printf("\n **> Currency of the receiver Account needs to be the same as the sender Account\n");
}

/* Transaction with an amount in USD from EUR to EUR Account - Error! */
try {
    $transaction6 = new Transaction($usd1000, $accountPeter, $accountAnna, new DateTimeImmutable('2016-07-20'));
} catch (InvalidTransactionException $e) {
    printf("\n **> Receivers Account-Currency needs to be the same as the senders Transaction Amount-Currency\n");
}

/* Total Balance till today */
printf("\n%s Account-Balance: %.2f %s", $accountPeter, $accountPeter->getBalance(), $accountPeter->getCurrency()->getSign());
printf("\n%s Account-Balance: %.2f %s", $accountAnna, $accountAnna->getBalance(), $accountAnna->getCurrency()->getSign());
printf("\n%s Account-Balance: %.2f %s", $accountSteven, $accountSteven->getBalance(), $accountSteven->getCurrency()->getSign());
printf("\n%s Account-Balance: %.2f %s\n", $accountValerie, $accountValerie->getBalance(), $accountValerie->getCurrency()->getSign());

/* Balance till date between Transaction1 and Transaction2 */
$selectedAccountDate = new DateTimeImmutable('2016-06-21');
printf("\n%s Account-Balance until %s: %.2f %s", $accountPeter, $selectedAccountDate->format('Y-m-d'),
    $accountPeter->getBalance($selectedAccountDate), $accountPeter->getCurrency()->getSign());
printf("\n%s Account-Balance until %s: %.2f %s", $accountAnna, $selectedAccountDate->format('Y-m-d'),
    $accountAnna->getBalance($selectedAccountDate), $accountAnna->getCurrency()->getSign());

/* Balance till date between Transaction1 and Transaction2 */
$selectedAccountDate = new DateTimeImmutable('2016-06-27');
printf("\n%s Account-Balance until %s: %.2f %s", $accountPeter, $selectedAccountDate->format('Y-m-d'),
    $accountPeter->getBalance($selectedAccountDate), $accountPeter->getCurrency()->getSign());
printf("\n%s Account-Balance until %s: %.2f %s\n", $accountAnna, $selectedAccountDate->format('Y-m-d'),
    $accountAnna->getBalance($selectedAccountDate), $accountAnna->getCurrency()->getSign());

/* Correction of Transaction2 (reverse booking) - new Transaction Correction with 90.50 */
$transaction2->reverse();
printf("\n%s : Transaction of %.2f from %s to %s REVERSED!", $transaction2->getFormattedAccountingDate(),
    $transaction2->getAmount(), $accountPeter, $accountAnna);

$transactionCorrection1 = new TransactionCorrection($eur9050, $accountPeter, $accountAnna, new DateTimeImmutable());
printf("\n%s : Transaction-Correction of %.2f from %s to %s\n", $transactionCorrection1->getFormattedAccountingDate(),
    $transactionCorrection1->getAmount(), $accountPeter, $accountAnna);

/* Total actual Balance till today */
printf("\n%s Account-Balance: %.2f %s", $accountPeter, $accountPeter->getBalance(), $accountPeter->getCurrency()->getSign());
printf("\n%s Account-Balance: %.2f %s\n", $accountAnna, $accountAnna->getBalance(), $accountAnna->getCurrency()->getSign());
