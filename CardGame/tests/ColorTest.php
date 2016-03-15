<?php

require_once '../src/Color.php';

class ColorTest extends PHPUnit_Framework_TestCase
{
    public function testInvalidColorThrowsException()
    {
        $this->expectException(InvalidArgumentException::class);
        new Color('Cyan');
    }
}
