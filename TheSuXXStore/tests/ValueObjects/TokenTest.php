<?php

class SuxxTokenTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var SuxxToken
     */
    private $token;

    protected function setUp()
    {
        $this->token = new SuxxToken('1234abcd');
    }

    public function testLength()
    {
        $token = new SuxxToken();
        $this->assertSame(40, strlen((string)$token));
    }

    public function testTokenCanBeComparedIfIsEqualToAnother()
    {
        $token1 = new SuxxToken('1234abcd');
        $this->assertTrue($this->token->isEqualTo($token1));
    }
}
