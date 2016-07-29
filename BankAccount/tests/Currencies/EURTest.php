<?php
declare(strict_types = 1);

namespace BankAccount\tests\Currencies
{
    use BankAccount\Currencies\EUR;

    /**
     * @covers \BankAccount\Currencies\Currency
     * @covers \BankAccount\Currencies\EUR
     */
    class EURTest extends \PHPUnit_Framework_TestCase
    {
        /**
         * @var EUR
         */
        private $eur;

        public function setUp()
        {
            $this->eur = new EUR();
        }

        public function testCurrencyCodeCanBeRetrieved()
        {
            $this->assertEquals('EUR', $this->eur->getCurrencyCode());
        }

        public function testDefaultFractionDigitsCanBeRetrieved()
        {
            $this->assertEquals(2, $this->eur->getDefaultFractionDigits());
        }

        public function testDisplayNameCanBeRetrieved()
        {
            $this->assertEquals('Euro', $this->eur->getDisplayName());
        }

        public function testSignCanBeRetrieved()
        {
            $this->assertEquals('€', $this->eur->getSign());
        }

        public function testSubUnitCanBeRetrieved()
        {
            $this->assertEquals(100, $this->eur->getSubUnit());
        }

        public function testStringOfObjectCanBeRetrieved()
        {
            $this->assertEquals('EUR', $this->eur);
        }
    }
}
