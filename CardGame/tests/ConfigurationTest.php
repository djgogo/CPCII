<?php


class ConfigurationTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Configuration
     */
    private $configuration;
    /**
     * @var integer
     */
    private $numberOfCards;

    public function setUp()
    {
        $this->numberOfCards = 5;
        $this->configuration = new Configuration();
    }

    public function testGetNumberOfCardsWorks()
    {
        $this->assertSame($this->numberOfCards, $this->configuration->getNumberOfCards());
    }
}
