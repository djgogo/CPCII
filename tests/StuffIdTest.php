<?php


class StuffIdTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException InvalidArgumentException
     */
    public function testStuffIdIsNotIntegerThrowsException()
    {
        new StuffId('ae47');
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testStuffIdIsNotBiggerThanZeroThrowsException()
    {
        new stuffId(-10);
    }
}
