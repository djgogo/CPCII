<?php

namespace Address\ValueObjects
{

    /**
     * @covers Address\ValueObjects\Username
     */
    class UsernameTest extends \PHPUnit_Framework_TestCase
    {
        public function testHappyPath()
        {
            $this->assertEquals('FooBar', new Username('FooBar'));
        }

        public function testIfUsernameIsTooLongThrowsException()
        {
            $tooLongUsername = str_repeat('x', 51);
            $this->expectException(\InvalidArgumentException::class);
            new Username($tooLongUsername);
        }
    }
}
