<?php
declare(strict_types = 1);

namespace BankAccount {

    class EcbCurrencyXmlParser
    {
        /**
         * @var \SimpleXMLElement
         */
        private $xml;

        /**
         * @var array
         */
        private $currencies = [];

        public function __construct(string $xmlLink)
        {
            $this->xml = simplexml_load_file($xmlLink);
            $this->parseXml();
        }

        private function parseXml()
        {
            foreach ($this->xml->Cube->Cube->Cube as $rate) {
                $this->currencies[(string)$rate['currency']] = (string)$rate['rate'];
            }
        }

        public function getCurrencies() : array
        {
            return $this->currencies;
        }
    }
}
