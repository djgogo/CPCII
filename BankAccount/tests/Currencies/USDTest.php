<?php
declare(strict_types = 1);

namespace BankAccount\tests\Currencies
{
    use BankAccount\Currencies\USD;

    /**
     * @covers \BankAccount\Currencies\Currency
     * @covers \BankAccount\Currencies\USD
     */
    class USDTest extends \PHPUnit_Framework_TestCase
    {
        /**
         * @var USD
         */
        private $usd;

        public function setUp()
        {
            $this->usd = new USD();
        }

        public function testCurrencyCodeCanBeRetrieved()
        {
            $this->assertEquals('USD', $this->usd->getCurrencyCode());
        }

        public function testDefaultFractionDigitsCanBeRetrieved()
        {
            $this->assertEquals(2, $this->usd->getDefaultFractionDigits());
        }

        public function testDisplayNameCanBeRetrieved()
        {
            $this->assertEquals('US Dollar', $this->usd->getDisplayName());
        }

        public function testSignCanBeRetrieved()
        {
            $this->assertEquals('$', $this->usd->getSign());
        }

        public function testSubUnitCanBeRetrieved()
        {
            $this->assertEquals(100, $this->usd->getSubUnit());
        }

        public function testStringOfObjectCanBeRetrieved()
        {
            $this->assertEquals('USD', $this->usd);
        }
    }
}
