<?php
declare(strict_types = 1);

namespace BankAccount
{
    use BankAccount\Currencies\Currency;
    use Composer\DependencyResolver\Operation\MarkAliasInstalledOperation;

    /**
     * @covers \BankAccount\Money
     * @uses \BankAccount\Currencies\Currency
     * @package BankAccount
     */
    class MoneyTest extends \PHPUnit_Framework_TestCase
    {
        /**
         * @var Currency
         */
        private $currency;

        /**
         * @var Money
         */
        private $money;

        public function setUp()
        {
            $this->currency = $this->getMockBuilder(Currency::class)
                ->disableOriginalConstructor()
                ->getMock();

            $this->money = new Money(123.45, $this->currency);
        }

        public function testAmountCanBeRetrieved()
        {
            $this->assertEquals(123.45, $this->money->getAmount());
        }

        public function testCurrencyCanBeRetrieved()
        {
            $this->assertEquals($this->currency, $this->money->getCurrency());
        }

        public function testMoneyCanBeAdded()
        {
            $newMoney = new Money(100.00, $this->currency);
            $expectedMoney = new Money(223.45, $this->currency);
            $this->assertEquals($expectedMoney, $this->money->add($newMoney));
        }

        public function testMoneyCanBeSubtracted()
        {
            $newMoney = new Money(100.00, $this->currency);
            $expectedMoney = new Money(23.45, $this->currency);
            $this->assertEquals($expectedMoney, $this->money->subtract($newMoney));
        }
    }
}
