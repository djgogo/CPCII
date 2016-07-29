<?php
declare(strict_types = 1);

namespace BankAccount\Handlers
{
    use BankAccount\Account;
    use BankAccount\Currencies\Currency;
    use BankAccount\CurrencyConverter;
    use BankAccount\Money;
    use BankAccount\Transaction;

    /**
     * @covers BankAccount\Handlers\TransactionHandler
     * @uses \BankAccount\Transaction
     * @uses \BankAccount\Currencies\Currency
     * @uses \BankAccount\Money
     * @uses \BankAccount\CurrencyConverter
     * @uses \BankAccount\Account
     * @package BankAccount\Handlers
     */
    class TransactionHandlerTest extends \PHPUnit_Framework_TestCase
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
         * @var \PHPUnit_Framework_MockObject_MockObject
         */
        private $transaction;

        /**
         * @var \PHPUnit_Framework_MockObject_MockObject
         */
        private $converter;

        /**
         * @var TransactionHandler
         */
        private $transactionHandler;

        /**
         * @var \PHPUnit_Framework_MockObject_MockObject
         */
        private $currency;

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

            $this->converter = $this->getMockBuilder(CurrencyConverter::class)
                ->disableOriginalConstructor()
                ->getMock();

            $this->transaction = $this->getMockBuilder(Transaction::class)
                ->disableOriginalConstructor()
                ->getMock();

            $this->currency = $this->getMockBuilder(Currency::class)
                ->disableOriginalConstructor()
                ->getMock();

            $this->transactionHandler = new TransactionHandler(
                $this->money,
                $this->sender,
                $this->receiver,
                new \DateTimeImmutable(),
                new \DateTimeImmutable(),
                $this->converter
            );
        }

//        public function testExecutionWithoutConversionCanBeDone()
//        {
//            $this->transaction
//                ->expects($this->once())
//                ->method('execute');
//
//            $this->transactionHandler->execute();
//        }

//        public function testTransactionCanBeRetrieved()
//        {
//            $this->assertEquals($this->transaction, $this->transactionHandler->getTransaction());
//        }

    }
}
