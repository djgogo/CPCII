<?php

class EmailTest extends PHPUnit_Framework_TestCase
{
    public function testEmailCanNotBeInvalid()
    {
        $this->expectException(InvalidEmailException::class);

        new Email('invalid');
    }

    public function testValidEmailCanBeCreated()
    {
        $this->assertEquals('foo@bar.com', new Email('foo@bar.com'));
    }
}
