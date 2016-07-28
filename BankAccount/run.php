<?php
declare(strict_types = 1);

use BankAccount\Account;
use BankAccount\Currencies\USD;
use BankAccount\Currencies\EUR;
use BankAccount\CurrencyConverter;
use BankAccount\EcbCurrencyXmlParser;
use BankAccount\Handlers\TransactionHandler;
use BankAccount\Money;
use BankAccount\TransactionCorrection;

require_once __DIR__ . '/bootstrap.php';

$eur = new EUR;
$usd = new USD;

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

$parser = new EcbCurrencyXmlParser('http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml');
$converter = new CurrencyConverter($parser);

/**
/* Transactions in EUR to EUR Account
 */
$transaction1 = new TransactionHandler(
    $eur10050,
    $accountPeter,
    $accountAnna,
    new DateTimeImmutable('2016-06-19'),
    new DateTimeImmutable('2016-06-19'),
    $converter
);
$transaction1->execute();
$transaction01 = $transaction1->getTransaction();

printf("\n%s : Transaction of %.2f %s from %s to %s",
    $transaction01->getFormattedAccountingDate(),
    $transaction01->getAmount(),
    $eur10050->getCurrency()->getSign(),
    $accountPeter,
    $accountAnna
);

$transaction2 = new TransactionHandler(
    $eur9950,
    $accountPeter,
    $accountAnna,
    new DateTimeImmutable('2016-06-19'),
    new DateTimeImmutable('2016-06-19'),
    $converter
);
$transaction2->execute();
$transaction02 = $transaction2->getTransaction();

printf("\n%s : Transaction of %.2f %s from %s to %s",
    $transaction02->getFormattedAccountingDate(),
    $transaction02->getAmount(),
    $eur9950->getCurrency()->getSign(),
    $accountPeter,
    $accountAnna
);

$transaction3 = new TransactionHandler(
    $eur1080,
    $accountAnna,
    $accountPeter,
    new DateTimeImmutable('2016-06-25'),
    new DateTimeImmutable('2016-06-25'),
    $converter
);
$transaction3->execute();
$transaction03 = $transaction3->getTransaction();

printf("\n%s : Transaction of %.2f %s from %s to %s",
    $transaction03->getFormattedAccountingDate(),
    $transaction03->getAmount(),
    $eur1080->getCurrency()->getSign(),
    $accountAnna,
    $accountPeter
);

$transaction7 = new TransactionHandler(
    $eur1000000,
    $accountPeter,
    $accountAnna,
    new DateTimeImmutable('2016-06-29'),
    new DateTimeImmutable('2016-06-29'),
    $converter
);
$transaction7->execute();
$transaction07 = $transaction7->getTransaction();

printf("\n%s : Transaction of %.2f %s from %s to %s",
    $transaction07->getFormattedAccountingDate(),
    $transaction07->getAmount(),
    $eur1000000->getCurrency()->getSign(),
    $accountPeter,
    $accountAnna
);

/**
 * Transaction in USD to USD Account
 */
$transaction4 = new TransactionHandler(
    $usd1000,
    $accountSteven,
    $accountValerie,
    new DateTimeImmutable('2016-06-30'),
    new DateTimeImmutable('2016-06-30'),
    $converter
);
$transaction4->execute();
$transaction04 = $transaction4->getTransaction();

printf("\n%s : Transaction of %.2f %s from %s to %s\n",
    $transaction04->getFormattedAccountingDate(),
    $transaction04->getAmount(),
    $usd1000->getCurrency()->getSign(),
    $accountSteven,
    $accountValerie
);

/**
 * Transaction from EUR to USD Account - Conversion!
 */
$transaction5 = new TransactionHandler(
    $eur10050,
    $accountPeter,
    $accountSteven,
    new DateTimeImmutable('2016-07-10'),
    new DateTimeImmutable('2016-07-10'),
    $converter
);
$transaction5->execute();
$transaction05 = $transaction5->getTransaction();

printf("\n%s : Transaction of %.2f %s converted to %.2f %s from %s to %s\n",
    $transaction05->getFormattedAccountingDate(),
    $eur10050->getAmount(),
    $eur10050->getCurrency()->getSign(),
    $transaction05->getAmount(),
    $transaction05->getMoney()->getCurrency()->getSign(),
    $accountPeter,
    $accountSteven
);

/**
 * Transaction from USD to EUR Account - Conversion!
 */
$transaction6 = new TransactionHandler(
    $usd1000,
    $accountValerie,
    $accountAnna,
    new DateTimeImmutable('2016-07-20'),
    new DateTimeImmutable('2016-07-20'),
    $converter
);
$transaction6->execute();
$transaction06 = $transaction6->getTransaction();

printf("\n%s : Transaction of %.2f %s converted to %.2f %s from %s to %s\n",
    $transaction06->getFormattedAccountingDate(),
    $usd1000->getAmount(),
    $usd1000->getCurrency()->getSign(),
    $transaction06->getAmount(),
    $transaction06->getMoney()->getCurrency()->getSign(),     //todo wrong sign??!!
    $accountValerie,
    $accountAnna
);

/**
 * Total Balance till today
 */
printf("\n%s Account-Balance: %.2f %s", $accountPeter, $accountPeter->getBalance(), $accountPeter->getCurrency()->getSign());
printf("\n%s Account-Balance: %.2f %s", $accountAnna, $accountAnna->getBalance(), $accountAnna->getCurrency()->getSign());
printf("\n%s Account-Balance: %.2f %s", $accountSteven, $accountSteven->getBalance(), $accountSteven->getCurrency()->getSign());
printf("\n%s Account-Balance: %.2f %s\n", $accountValerie, $accountValerie->getBalance(), $accountValerie->getCurrency()->getSign());

/**
 * Correction of Transaction2 (reverse booking) - new Transaction Correction with 90.50
 * Converted Transaction's not implemented for Correction yet!!!
 */
$transaction02->reverse();
printf("\n%s : Transaction 2 of %.2f from %s to %s REVERSED!",
    $transaction02->getFormattedAccountingDate(),
    $transaction02->getAmount(),
    $accountPeter,
    $accountAnna
);

$transactionCorrection1 = new TransactionCorrection(
    $eur9050,
    $accountPeter,
    $accountAnna,
    new DateTimeImmutable(),
    new DateTimeImmutable('2016-06-19'),
    $transaction02
);
$transactionCorrection1->execute();

printf("\n%s : Transaction-Correction of %.2f from %s to %s : replacing Transaction2 from %s\n",
    $transactionCorrection1->getFormattedAccountingDate(),
    $transactionCorrection1->getAmount(),
    $accountPeter, $accountAnna,
    $transaction02->getFormattedAccountingDate()
);

/**
 * Total actual Balance till today
 */
printf("\n%s Account-Balance: %.2f %s", $accountPeter, $accountPeter->getBalance(), $accountPeter->getCurrency()->getSign());
printf("\n%s Account-Balance: %.2f %s\n", $accountAnna, $accountAnna->getBalance(), $accountAnna->getCurrency()->getSign());

/**
 * Balance between Transaction1 and Transaction2 Value-Date
 */
$selectedValueDate = new DateTimeImmutable('2016-06-21');
printf("\n%s Account-Balance until %s: %.2f %s", $accountPeter, $selectedValueDate->format('Y-m-d'),
    $accountPeter->getBalance($selectedValueDate), $accountPeter->getCurrency()->getSign());
printf("\n%s Account-Balance until %s: %.2f %s", $accountAnna, $selectedValueDate->format('Y-m-d'),
    $accountAnna->getBalance($selectedValueDate), $accountAnna->getCurrency()->getSign());

/**
 * Balance between Transaction3 and Transaction4 Value-Date
 */
$selectedValueDate = new DateTimeImmutable('2016-06-27');
printf("\n%s Account-Balance until %s: %.2f %s", $accountPeter, $selectedValueDate->format('Y-m-d'),
    $accountPeter->getBalance($selectedValueDate), $accountPeter->getCurrency()->getSign());
printf("\n%s Account-Balance until %s: %.2f %s\n", $accountAnna, $selectedValueDate->format('Y-m-d'),
    $accountAnna->getBalance($selectedValueDate), $accountAnna->getCurrency()->getSign());
