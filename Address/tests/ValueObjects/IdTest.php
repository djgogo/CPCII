<?php

namespace Address\ValueObjects
{
    /**
     * @covers  Address\ValueObjects\Id
     */
    class IdTest extends \PHPUnit_Framework_TestCase
    {
        public function testIdThrowsExceptionIfItsNegative()
        {
            $this->expectException(\InvalidArgumentException::class);
            new Id(-1);
        }
    }
}
