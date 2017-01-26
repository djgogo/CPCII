<?php

namespace Address\Factories {

    use Address\Exceptions\InvalidPdoAttributeException;

    /**
     * Class PDOFactoryTest
     * @package Address\Factories
     */
    class PDOFactoryTest extends \PHPUnit_Framework_TestCase
    {
        /**
         * @var PDOFactory
         */
        private $pdoFactory;

        protected function setUp()
        {
            $this->pdoFactory = new PDOFactory('localhost', 'Cart', 'root', '1234', 'utf8');
        }

        public function testPdoDatabaseHandlerCanBeRetrieved()
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
            $wrongPdo = new PDOFactory('localhost', 'Cart', 'anyUser', 'anyPassword', 'utf8');
            $wrongPdo->getDbHandler();
        }
    }
}
