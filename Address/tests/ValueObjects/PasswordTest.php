<?php

namespace Address\ValueObjects
{
    class PasswordTest extends \PHPUnit_Framework_TestCase
    {
        public function testHappyPath()
        {
            $this->assertEquals('123456', new Password('123456'));
        }

        public function testIfPasswordIsToBigThrowsException()
        {
            $tooLongPassword = str_repeat('x', 256);
            $this->expectException(\InvalidArgumentException::class);
            new Password($tooLongPassword);
        }

        public function testIfPasswordIsNotBigEnoughThrowsException()
        {
            $this->expectException(\InvalidArgumentException::class);
            new Password('123');
        }
    }
}
