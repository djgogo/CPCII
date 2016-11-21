<?php

class SuxxErrorLogger
{
    public function log(string $message, Exception $e = null)
    {
        $datetime = new DateTime();
        $datetime->setTimezone(new DateTimeZone('UTC'));

        $logEntry = $datetime->format('Y/m/d H:i:s') . ' / ' .
            $message . ' / ' .
            $e->getMessage() . '/' .
            $e->getCode() . ' / ' .
            $e->getFile() . ' / ' .
            $e->getLine();

        error_log($logEntry, 3, __DIR__ . '/../../logs/error.log');
    }
}
