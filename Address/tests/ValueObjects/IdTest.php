<?php

namespace Address\ValueObjects
{
    /**
     * @covers  Address\ValueObjects\Id
     */
    class IdTest extends \PHPUnit_Framework_TestCase
    {
        public function testHappyPath()
        {
            $id = 123;
            $zip = new Id($id);
            $this->assertEquals($id, (string) $zip);
        }

        public function testIdThrowsExceptionIfItsNegative()
        {
            $this->expectException(\InvalidArgumentException::class);
            new Id(-1);
        }
    }
}
