<?php
declare(strict_types=1);

class NicknameTest extends PHPUnit_Framework_TestCase
{
    public function testCannotBeEmpty()
    {
        $this->expectException(EmptyNicknameException::class);

        new Nickname('');
    }
}
