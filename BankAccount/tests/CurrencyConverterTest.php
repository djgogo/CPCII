<?php
declare(strict_types = 1);

namespace BankAccount
{
    use BankAccount\Currencies\EUR;
    use BankAccount\Currencies\USD;

    /**
     * @covers \BankAccount\CurrencyConverter
     * @uses \BankAccount\Currencies\EUR
     * @uses \BankAccount\EcbCurrencyXmlParser
     * @uses \BankAccount\Money
     * @package BankAccount
     */
    class CurrencyConverterTest extends \PHPUnit_Framework_TestCase
    {
        /**
         * @var \PHPUnit_Framework_MockObject_MockObject
         */
        private $eur;

        /**
         * @var \PHPUnit_Framework_MockObject_MockObject
         */
        private $usd;

        /**
         * @var \PHPUnit_Framework_MockObject_MockObject
         */
        private $ecbCurrencyXmlParser;

        /**
         * @var CurrencyConverter
         */
        private $currencyConverter;

        /**
         * @var \PHPUnit_Framework_MockObject_MockObject
         */
        private $money;

        public function setUp()
        {
            $this->eur = $this->getMockBuilder(EUR::class)
                ->disableOriginalConstructor()
                ->getMock();

            $this->usd = $this->getMockBuilder(USD::class)
                ->disableOriginalConstructor()
                ->getMock();

            $this->ecbCurrencyXmlParser = $this->getMockBuilder(EcbCurrencyXmlParser::class)
                ->disableOriginalConstructor()
                ->getMock();

            $this->money = $this->getMockBuilder(Money::class)
                ->disableOriginalConstructor()
                ->getMock();

            $this->currencyConverter = new CurrencyConverter($this->ecbCurrencyXmlParser);
        }

//        public function testUSDToEURCanBeConverted()
//        {
//            // TODO Test for convert method EUR->USD and USD->EUR
//
//            $result = $this->currencyConverter->convert($this->usd, $this->eur, 100.00);
//            $this->assertEquals(101.00, $result);
//        }
    }
}
