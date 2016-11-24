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
            //$this->path = '/../TestFiles/testError.log';
            $this->path = '/var/www/Exercises/TheSuXXStore/tests/TestFiles/testError.log';
            $this->e = new \Exception();

            $this->errorLogger = new ErrorLogger($this->dateTime, $this->path);
        }

//        public function testLoggingExceptionWorks()
//        {
//            $expectedString = 'Test';
//            $this->errorLogger->log('Test Exception Logging', $this->e);
//
//            $this->assertEquals($expectedString, file_get_contents($this->path));
//
//            unlink($this->path);
//        }

        public function testLoggingMessageWorks()
        {
            $backTrace = [
                    ['file' => '/testFile', 'line' => '99']
                ];

            $expectedString = 'Test';
            $this->errorLogger->logMessage('Test Message Logging', $backTrace);

            $this->assertEquals($expectedString, file_get_contents($this->path));

            unlink($this->path);
        }
    }
}
