<?php

/**
 * Class CardTest - NOT working - because logger isn't anymore in the class
 */
class CardTest extends PHPUnit_Framework_TestCase
{
    public function testTurned()
    {
        $logger = $this->getMockBuilder(Logger::class)->disableOriginalConstructor()->getMock();

        $logger->expects($this->once())->method('log')->with('Die Karte Blue wurde gedreht');

        $card = new Card('Blue', $logger);
        $this->assertFalse($card->isRevealed());
        $card->turn();
        $this->assertTrue($card->isRevealed());
    }
}
