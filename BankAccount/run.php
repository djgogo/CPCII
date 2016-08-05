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

$eur10050 = new Money(10050, $eur);
$eur1000000 = new Money(100000, $eur);
$eur9950 = new Money(9950, $eur);
$eur9050 = new Money(9050, $eur);
$eur1080 = new Money(1080, $eur);
$usd1000 = new Money(1000, $usd);
$usd2000 = new Money(2000, $usd);

$parser = new EcbCurrencyXmlParser('http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml');
$converter = new CurrencyConverter($parser);
$formatter = new \BankAccount\AmountFormatter();

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

printf("\n%s : Transaction of %s from %s to %s",
    $transaction01->getFormattedAccountingDate(),
    $formatter->format($transaction01->getAmount()),
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

printf("\n%s : Transaction of %s from %s to %s",
    $transaction02->getFormattedAccountingDate(),
    $formatter->format($transaction02->getAmount()),
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

printf("\n%s : Transaction of %s from %s to %s",
    $transaction03->getFormattedAccountingDate(),
    $formatter->format($transaction03->getAmount()),
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

printf("\n%s : Transaction of %s from %s to %s",
    $transaction07->getFormattedAccountingDate(),
    $formatter->format($transaction07->getAmount()),
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

printf("\n%s : Transaction of %s from %s to %s\n",
    $transaction04->getFormattedAccountingDate(),
    $formatter->format($transaction04->getAmount()),
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

printf("\n%s : Transaction of %s converted to %s from %s to %s\n",
    $transaction05->getFormattedAccountingDate(),
    $formatter->format($eur10050),
    $formatter->format($transaction05->getAmount()),
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

printf("\n%s : Transaction of %s converted to %s from %s to %s\n",
    $transaction06->getFormattedAccountingDate(),
    $formatter->format($usd1000),
    $formatter->format($transaction06->getAmount()),
    $accountValerie,
    $accountAnna
);

/**
 * Total Balance till today
 */
printf("\n%s Account-Balance: %s",
    $accountPeter,
    $formatter->format($accountPeter->getBalance())
);
printf("\n%s Account-Balance: %s",
    $accountAnna,
    $formatter->format($accountAnna->getBalance())
);
printf("\n%s Account-Balance: %s",
    $accountSteven,
    $formatter->format($accountSteven->getBalance())
);
printf("\n%s Account-Balance: %s\n",
    $accountValerie,
    $formatter->format($accountValerie->getBalance())
);

/**
 * Correction of Transaction2 (reverse booking) - new Transaction Correction with 90.50
 * Converted Transaction's not implemented for Correction yet!!!
 */
$transaction02->reverse();
printf("\n%s : Transaction 2 of %s from %s to %s REVERSED!",
    $transaction02->getFormattedAccountingDate(),
    $formatter->format($transaction02->getAmount()),
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

printf("\n%s : Transaction-Correction of %s from %s to %s : replacing Transaction2 from %s\n",
    $transactionCorrection1->getFormattedAccountingDate(),
    $formatter->format($transactionCorrection1->getAmount()),
    $accountPeter, $accountAnna,
    $transaction02->getFormattedAccountingDate()
);

/**
 * Total actual Balance till today
 */
printf("\n%s Account-Balance: %s",
    $accountPeter,
    $formatter->format($accountPeter->getBalance())
);
printf("\n%s Account-Balance: %s\n",
    $accountAnna,
    $formatter->format($accountAnna->getBalance())
);

/**
 * Balance between Transaction1 and Transaction2 Value-Date
 */
$selectedValueDate = new DateTimeImmutable('2016-06-21');
printf("\n%s Account-Balance until %s: %s",
    $accountPeter,
    $selectedValueDate->format('Y-m-d'),
    $formatter->format($accountPeter->getBalance($selectedValueDate))
);
printf("\n%s Account-Balance until %s: %s",
    $accountAnna,
    $selectedValueDate->format('Y-m-d'),
    $formatter->format($accountAnna->getBalance($selectedValueDate))
);

/**
 * Balance between Transaction3 and Transaction4 Value-Date
 */
$selectedValueDate = new DateTimeImmutable('2016-06-27');
printf("\n%s Account-Balance until %s: %s",
    $accountPeter,
    $selectedValueDate->format('Y-m-d'),
    $formatter->format($accountPeter->getBalance($selectedValueDate))
);
printf("\n%s Account-Balance until %s: %s\n",
    $accountAnna,
    $selectedValueDate->format('Y-m-d'),
    $formatter->format($accountAnna->getBalance($selectedValueDate))
);
