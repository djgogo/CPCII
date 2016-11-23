<?php

namespace Suxx\Loggers
{
    class ErrorLogger //Logerinterface, wodurch man alternative logger verwenden kann? (z.b. graylog, datenbank, email, ...)
    {
        public function log(string $message, \Exception $e = null)
        {
            $datetime = new \DateTime(); //dependency?
            $datetime->setTimezone(new \DateTimeZone('Europe/Zurich'));

            $logEntry = $datetime->format('Y/m/d H:i:s') . ' / ' .
                $message . ' / ' .
                $e->getMessage() . '/' .
                $e->getCode() . ' / ' .
                $e->getFile() . ' / ' .
                $e->getLine();

            error_log($logEntry . PHP_EOL, 3, __DIR__ . '/../../logs/error.log'); //log pfad als depencency / konfigurierbar?
        }
    }
}
