<?php

class ColorTest extends PHPUnit_Framework_TestCase
{
    public function testInvalidColorThrowsException()
    {
        $this->expectException(InvalidArgumentException::class);
        new Color('Cyan');
    }

    public function testCreateInstanceofColorWithValidColorWorks()
    {
        $this->assertInstanceOf(Color::class, new Color('Blue'));
    }

    public function testColorConvertionToStringWorks()
    {
        $color = new Color('Blue');
        $this->assertSame('Blue', (string)$color);
    }
}
