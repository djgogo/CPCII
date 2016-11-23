<?php

namespace Suxx\Factories {

    use Suxx\Exceptions\InvalidPdoAttributeException;
    use Suxx\Loggers\ErrorLogger;

    // Covers Fehlt
    /**
     * Class PDOFactoryTest
     * @package Suxx\Factories
     */
    class PDOFactoryTest extends \PHPUnit_Framework_TestCase
    {
        /**
         * @var PDOFactory
         */
        private $pdoFactory;

        protected function setUp()
        {
            $this->pdoFactory = new PDOFactory('localhost', 'suxx', 'suxxuser', 'thesuxxstore', new ErrorLogger());
        }

        public function testDatabaseHandlerPdoCanBeRetrieved()
        {
            $this->assertInstanceOf(\PDO::class, $this->pdoFactory->getDbHandler());
        }

        public function testPdoIsAlwaysTheSameObject()
        {
            $this->assertSame($this->pdoFactory->getDbHandler(), $this->pdoFactory->getDbHandler());
            $this->assertInstanceOf(\PDO::class, $this->pdoFactory->getDbHandler());
        }

        public function testGetDbHandlerWithWrongCredentialsThrowsException()
        {
            $this->expectException(InvalidPdoAttributeException::class);
            $wrongPdo = new PDOFactory('localhost', 'suxx', 'anyUser', 'anyPassword', new ErrorLogger());
            $wrongPdo->getDbHandler();
        }
    }
}
