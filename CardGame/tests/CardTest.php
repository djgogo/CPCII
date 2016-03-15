<?php

require_once '../src/Card.php';

class CardTest extends PHPUnit_Framework_TestCase

{
    /**
     * @var Color
     */
    private $color;

    /**
     * @var Card
     */
    private $card;

    public function setUp()
    {
        $this->color = $this->getMockBuilder(Color::class)->disableOriginalConstructor()->getMock();
        $this->card = new Card($this->color);
    }

    public function testGetColor()
    {
        $this->assertEquals($this->color,$this->card->getColor());
    }

    public function testTurnedAndIsRevealed()
    {
        $card = new Card($this->color);
        $this->assertFalse($card->isRevealed());
        $card->turn();
        $this->assertTrue($card->isRevealed());
    }
}
