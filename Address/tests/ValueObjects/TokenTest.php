<?php

namespace Address\ValueObjects {

    /**
     * @covers  Address\ValueObjects\Token
     */
    class TokenTest extends \PHPUnit_Framework_TestCase
    {
        /** @var Token */
        private $token;

        protected function setUp()
        {
            $this->token = new Token('1234abcd');
        }

        public function testLength()
        {
            $token = new Token();
            $this->assertSame(40, strlen((string)$token));
        }

        public function testTokenCanBeComparedIfIsEqualToAnother()
        {
            $token1 = new Token('1234abcd');
            $this->assertTrue($this->token->isEqualTo($token1));
        }
    }
}
