<?php

namespace Suxx\Loggers {

    class ErrorLoggerTest extends \PHPUnit_Framework_TestCase
    {
        /**
         * @var \DateTime
         */
        private $dateTime;

        /**
         * @var string
         */
        private $path;

        /**
         * @var \Exception
         */
        private $e;

        /**
         * @var ErrorLogger
         */
        private $errorLogger;

        public function setUp()
        {
            $this->dateTime = new \DateTime();
            $this->path = __DIR__ . '/../TestFiles/errorTest.log';
            $this->e = new \Exception();

            $this->errorLogger = new ErrorLogger($this->dateTime, $this->path);
        }

        public function testLoggingExceptionWorks()
        {
            $expectedString = 'Test Exception Logging / /0 / /var/www/Exercises/TheSuXXStore/tests/Loggers/ErrorLoggerTest.php / 31';
            $this->errorLogger->log('Test Exception Logging', $this->e);

            $logStringWithoutDateTime = trim(substr(file_get_contents($this->path), 22));
            $this->assertEquals($expectedString, $logStringWithoutDateTime);

            unlink($this->path);
        }

        public function testLoggingMessageWorks()
        {
            $backTrace = [
                    ['file' => '/testFile', 'line' => '99']
                ];

            $expectedString = 'Test Message Logging / /testFile / 99';
            $this->errorLogger->logMessage('Test Message Logging', $backTrace);

            $logStringWithoutDateTime = trim(substr(file_get_contents($this->path), 22));
            $this->assertEquals($expectedString, $logStringWithoutDateTime);

            unlink($this->path);
        }
    }
}
