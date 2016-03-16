<?php

/**
 * @covers Logger
 */
class LoggerTest extends PHPUnit_Framework_TestCase
{
    public function testExpectedLogMessage()
    {
        $msg = 'Test Output String';
        $out = '[37m';
        $logger = new Logger();

        $message = "\n " . chr(27) . "$out" . "$msg" . chr(27) . "[0m \n";

        $this->expectOutputString($message);

        $logger->log('Test Output String', 'white');
    }
}
