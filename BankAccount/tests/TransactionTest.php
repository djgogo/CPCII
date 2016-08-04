<?php
declare(strict_types = 1);

namespace BankAccount
{
    /**
     * @covers \BankAccount\Transaction
     * @uses \BankAccount\Money
     * @uses \BankAccount\Account
     * @package BankAccount
     */
    class TransactionTest extends \PHPUnit_Framework_TestCase
    {
        /**
         * @var \PHPUnit_Framework_MockObject_MockObject
         */
        private $money;

        /**
         * @var \PHPUnit_Framework_MockObject_MockObject
         */
        private $sender;

        /**
         * @var \PHPUnit_Framework_MockObject_MockObject
         */
        private $receiver;

        /**
         * @var Transaction
         */
        private $transaction;

        public function setUp()
        {
            $this->money = $this->getMockBuilder(Money::class)
                ->disableOriginalConstructor()
                ->getMock();

            $this->sender = $this->getMockBuilder(Account::class)
                ->disableOriginalConstructor()
                ->getMock();

            $this->receiver = $this->getMockBuilder(Account::class)
                ->disableOriginalConstructor()
                ->getMock();

            $this->transaction = new Transaction(
                $this->money,
                $this->sender,
                $this->receiver,
                new \DateTimeImmutable(),
                new \DateTimeImmutable()
            );
        }

        public function testTransactionCanBeExecuted()
        {
            $this->sender
                ->expects($this->once())
                ->method('addCredit')
                ->with($this->transaction);

            $this->receiver
                ->expects($this->once())
                ->method('addDebit')
                ->with($this->transaction);

            $this->transaction->execute();
        }

        public function testReversionCanBeDone()
        {
            $this->sender
                ->expects($this->once())
                ->method('addDebit')
                ->with($this->transaction);

            $this->receiver
                ->expects($this->once())
                ->method('addCredit')
                ->with($this->transaction);

            $this->transaction->reverse();
        }

        public function testAmountCanBeRetrieved()
        {
            $this->money
                ->expects($this->once())
                ->method('getAmount')
                ->willReturn(123.45);

            $this->assertEquals(123.45, $this->transaction->getAmount());
        }

        public function testAccountingDateCanBeRetrieved()
        {
            $expected = new \DateTimeImmutable();
            $this->assertEquals($expected, $this->transaction->getAccountingDate());
        }

        public function testValueDateCanBeRetrieved()
        {
            $expected = new \DateTimeImmutable();
            $this->assertEquals($expected, $this->transaction->getValueDate());
        }

        public function testFormattedAccountingDateCanBeRetrieved()
        {
            $expected = new \DateTimeImmutable();
            $expected = $expected->format('Y-m-d');
            $this->assertEquals($expected, $this->transaction->getFormattedAccountingDate());
        }

        public function testMoneyCanBeRetrieved()
        {
            $this->assertEquals($this->money, $this->transaction->getMoney());
        }

    }
}
