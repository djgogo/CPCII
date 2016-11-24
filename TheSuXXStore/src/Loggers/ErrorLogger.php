<?php

namespace Suxx\Loggers
{
    class ErrorLogger implements LoggerInterface
    {
        /**
         * @var \DateTime
         */
        private $dateTime;

        /**
         * @var string
         */
        private $path;

        public function __construct(\DateTime $dateTime, string $path)
        {
            $this->dateTime = $dateTime;
            $this->path = $path;
        }

        public function log(string $message, \Exception $e = null)
        {
            $logEntry = $this->dateTime->format('Y/m/d H:i:s') . ' / ' .
                $message . ' / ' .
                $e->getMessage() . '/' .
                $e->getCode() . ' / ' .
                $e->getFile() . ' / ' .
                $e->getLine();

            error_log($logEntry . PHP_EOL, 3, __DIR__ . $this->path);
        }

        public function logMessage(string $message, $b = [])
        {
            var_dump($this->path); exit;

            $logEntry = $this->dateTime->format('Y/m/d H:i:s') . ' / ' .
                $message . ' / ' .
                $b[0]['file'] . ' / ' .
                $b[0]['line'];

            error_log($logEntry . PHP_EOL, 3, __DIR__ . $this->path);
        }
    }
}
