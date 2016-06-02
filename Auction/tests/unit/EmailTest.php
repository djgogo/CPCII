<?php
declare(strict_types=1);

class EmailTest extends PHPUnit_Framework_TestCase
{
    public function testCannotBeInvalid()
    {
        $this->expectException(InvalidEmailException::class);

        new Email('invalid');
    }
}
