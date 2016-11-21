<?php

class PDOFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var PDOFactory
     */
    private $pdoFactory;

    protected function setUp()
    {
        $this->pdoFactory = new PDOFactory('localhost', 'suxx', 'suxxuser', 'thesuxxstore', new SuxxErrorLogger());
    }

    public function testDatabaseHandlerPdoCanBeRetrieved()
    {
        $this->assertInstanceOf(PDO::class, $this->pdoFactory->getDbHandler());
    }

    public function testPdoIsAlwaysTheSameObject()
    {
        $this->assertSame($this->pdoFactory->getDbHandler(), $this->pdoFactory->getDbHandler());
        $this->assertInstanceOf(PDO::class, $this->pdoFactory->getDbHandler());
    }

    public function testGetDbHandlerWithWrongCredentialsThrowsException()
    {
        $this->expectException(SuxxInvalidPdoAttributeException::class);
        $wrongPdo = new PDOFactory('localhost', 'suxx', 'anyUser', 'anyPassword', new SuxxErrorLogger());
        $wrongPdo->getDbHandler();
    }
}
