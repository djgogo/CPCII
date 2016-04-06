<?php

/**
 * @covers Logger
 */
class LoggerTest extends PHPUnit_Framework_TestCase
{
    public function testExpectedLogMessageWhite()
    {
        $msg = 'Test Output String';
        $out = '[37m';
        $logger = new Logger();

        $message = "\n " . chr(27) . "$out" . "$msg" . chr(27) . "[0m \n";

        $this->expectOutputString($message);
        $logger->log('Test Output String', 'white');
    }

    public function testExpectedLogMessageCyan()
    {
        $msg = 'Test Output String';
        $out = '[36m';
        $logger = new Logger();

        $message = "\n " . chr(27) . "$out" . "$msg" . chr(27) . "[0m \n";

        $this->expectOutputString($message);
        $logger->log('Test Output String', 'cyan');
    }

    public function testExpectedLogMessageMagenta()
    {
        $msg = 'Test Output String';
        $out = '[35m';
        $logger = new Logger();

        $message = "\n " . chr(27) . "$out" . "$msg" . chr(27) . "[0m \n";

        $this->expectOutputString($message);
        $logger->log('Test Output String', 'magenta');
    }

    public function testExpectedLogMessageBlue()
    {
        $msg = 'Test Output String';
        $out = '[34m';
        $logger = new Logger();

        $message = "\n " . chr(27) . "$out" . "$msg" . chr(27) . "[0m \n";

        $this->expectOutputString($message);
        $logger->log('Test Output String', 'blue');
    }

    public function testExpectedLogMessageYellow()
    {
        $msg = 'Test Output String';
        $out = '[33m';
        $logger = new Logger();

        $message = "\n " . chr(27) . "$out" . "$msg" . chr(27) . "[0m \n";

        $this->expectOutputString($message);
        $logger->log('Test Output String', 'yellow');
    }

    public function testExpectedLogMessageGreen()
    {
        $msg = 'Test Output String';
        $out = '[32m';
        $logger = new Logger();

        $message = "\n " . chr(27) . "$out" . "$msg" . chr(27) . "[0m \n";

        $this->expectOutputString($message);
        $logger->log('Test Output String', 'green');
    }

    public function testExpectedLogMessageRed()
    {
        $msg = 'Test Output String';
        $out = '[31m';
        $logger = new Logger();

        $message = "\n " . chr(27) . "$out" . "$msg" . chr(27) . "[0m \n";

        $this->expectOutputString($message);
        $logger->log('Test Output String', 'red');
    }
}
