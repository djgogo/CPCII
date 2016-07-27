<?php
declare(strict_types = 1);

class Transaction
{
    /**
     * @var Account
     */
    private $sender;

    /**
     * @var Account
     */
    private $receiver;

    /**
     * @var Money
     */
    private $money;

    /**
     * @var DateTimeImmutable
     */
    private $accountingDate;

    /**
     * @var DateTimeImmutable
     */
    private $valueDate;

    /**
     * @var CurrencyConverter
     */
    private $converter;

    /**
     * @var float
     */
    private $convertedMoney;

    public function __construct(
        Money $money,
        Account $sender,
        Account $receiver,
        \DateTimeImmutable $accountingDate,
        \DateTimeImmutable $valueDate,
        CurrencyConverter $converter)
    {
        $this->sender = $sender;
        $this->receiver = $receiver;
        $this->money = $money;
        $this->accountingDate = $accountingDate;
        $this->valueDate = $valueDate;
        $this->converter = $converter;
//        $this->ensureSameAccountCurrency();
//        $this->ensureRightTransactionCurrency();
        $this->handleCurrencyConversion();
        $this->executeTransaction();
    }

    private function executeTransaction()
    {
        $this->sender->addCredit($this);
        $this->receiver->addDebit($this);
    }

    public function reverse()
    {
        $this->sender->addDebit($this);
        $this->receiver->addCredit($this);
    }

    public function getAmount() : float
    {
        return $this->money->getAmount();
    }

    public function getConvertedAmount() : Money
    {
        return $this->convertedMoney;
    }

    public function getAccountingDate() : DateTimeImmutable
    {
        return $this->accountingDate;
    }

    public function getValueDate() : DateTimeImmutable
    {
        return $this->valueDate;
    }

    public function getFormattedAccountingDate() : string
    {
        return $this->accountingDate->format('Y-m-d');
    }

//    private function ensureSameAccountCurrency()
//    {
//        if ($this->sender->getCurrency() != $this->receiver->getCurrency()) {
//            throw new InvalidTransactionException('Currency of the receiver Account needs to be the same as the sender Account');
//        }
//    }

    private function isReceiverAccountCurrencyEqualSenderAmountCurrency() : bool
    {
        if ($this->money->getCurrency() != $this->receiver->getCurrency()) {
            //throw new InvalidTransactionException('Receivers Account-Currency needs to be the same as the senders Amount-Currency');
            return false;
        }
        return true;
    }

    private function handleCurrencyConversion()
    {
        if (!$this->isReceiverAccountCurrencyEqualSenderAmountCurrency() && $this->receiver->getCurrency()->getCurrencyCode() == 'EUR') {
            $this->convertedMoney = $this->converter->convert($this->money->getCurrency()->getCurrencyCode(),
                $this->receiver->getCurrency()->getCurrencyCode(), $this->getAmount());
        }

        if (!$this->isReceiverAccountCurrencyEqualSenderAmountCurrency() && $this->receiver->getCurrency()->getCurrencyCode() == 'USD') {
            $this->convertedMoney = $this->converter->convert($this->receiver->getCurrency()->getCurrencyCode(),
                $this->receiver->getCurrency()->getCurrencyCode(), $this->getAmount());
        }
    }
}
