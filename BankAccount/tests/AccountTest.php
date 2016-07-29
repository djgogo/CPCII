<?php
declare(strict_types = 1);

namespace BankAccount
{
    use BankAccount\Currencies\Currency;

    /**
     * @covers \BankAccount\Account
     * @covers \BankAccount\AccountInterface
     * @uses \BankAccount\Currencies\Currency
     * @uses \BankAccount\Transaction
     * @package BankAccount
     */
    class AccountTest extends \PHPUnit_Framework_TestCase
    {
        /**
         * @var \PHPUnit_Framework_MockObject_MockObject
         */
        private $currency;

        /**
         * @var \PHPUnit_Framework_MockObject_MockObject
         */
        private $transaction;

        /**
         * @var Account
         */
        private $account;

        public function setUp()
        {
            $this->currency = $this->getMockBuilder(Currency::class)
                ->disableOriginalConstructor()
                ->getMock();

            $this->transaction = $this->getMockBuilder(Transaction::class)
                ->disableOriginalConstructor()
                ->getMock();

            $this->account = new Account('TestAccount', 123456, $this->currency);
        }

        public function testCreditCanBeAddedAndReturnsTheRightBalance()
        {
            $this->transaction
                ->expects($this->once())
                ->method('getAccountingDate')
                ->willReturn(new \DateTimeImmutable());

            $this->transaction
                ->expects($this->once())
                ->method('getValueDate')
                ->willReturn(new \DateTimeImmutable());

            $this->transaction
                ->expects($this->once())
                ->method('getAmount')
                ->willReturn(123.45);

            $this->account->addCredit($this->transaction);
            $this->assertEquals(-123.45, $this->account->getBalance());
        }

        public function testDebitCanBeAddedAndReturnsTheRightBalance()
        {
            $this->transaction
                ->expects($this->once())
                ->method('getAccountingDate')
                ->willReturn(new \DateTimeImmutable());

            $this->transaction
                ->expects($this->once())
                ->method('getValueDate')
                ->willReturn(new \DateTimeImmutable());

            $this->transaction
                ->expects($this->once())
                ->method('getAmount')
                ->willReturn(123.45);

            $this->account->addDebit($this->transaction);
            $this->assertEquals(123.45, $this->account->getBalance());
        }

        public function testCurrencyCanBeRetrieved()
        {
            $this->assertEquals($this->currency, $this->account->getCurrency());
        }

        public function testObjectCanBeRetrievedAsString()
        {
            $this->assertEquals('TestAccount', $this->account);
        }
    }
}
