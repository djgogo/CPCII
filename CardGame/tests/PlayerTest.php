<?php

class PlayerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $dice;
    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $logger;
    /**
     * @var Player
     */
    private $player;
    /**
     * @var string
     */
    private $name;
    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $card;
    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $color;

    public function setUp()
    {
        $this->name = 'Alice';
        $this->logger = $this->getMock(LoggerInterface::class);
        $this->dice = $this->getMockBuilder(Dice::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->color = $this->getMockBuilder(Color::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->card = $this->getMockBuilder(Card::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->player = new Player($this->name, $this->dice, $this->logger);
        $this->player->addCard($this->card);
    }

    public function testGetName()
    {
        $this->assertEquals($this->name, $this->player->getName());
    }

    public function testRollDiceAndTurnMatchingCardWorks()
    {
        // roll the dice once and get diced color
        $this->dice->expects($this->once())
            ->method('roll')
            ->will($this->returnValue($this->color));

        // let the comparison get true with same color
        $this->card->expects($this->once())
            ->method('getColor')
            ->will($this->returnValue($this->color));

        // make sure the method turn is called
        $this->card->expects($this->once())
            ->method('turn');

        // EXECUTE method
        $this->player->rollDiceAndTurnMatchingCard();
    }

    public function testRollDiceAndColorDoesNotMatchCardWorks()
    {
        // roll the dice once and get diced color
        $this->dice->expects($this->once())
            ->method('roll')
            ->will($this->returnValue($this->color));

        // create wrong color for the negate test
        $wrongColor = $this->getMockBuilder(Color::class)
            ->disableOriginalConstructor()
            ->getMock();

        // let the comparison fail with the wrong color
        $this->card->expects($this->once())
            ->method('getColor')
            ->will($this->returnValue($wrongColor));

        // make sure turn is not called if wrong color
        $this->card->expects($this->never())
            ->method('turn');

        // Card is not revealed, so log the message
        $this->card->expects($this->once())
            ->method('isRevealed')
            ->will($this->returnValue(false));

        // EXECUTE method
        $this->player->rollDiceAndTurnMatchingCard();
    }

    public function testHasAllCardsTurnedWorks()
    {
        // TODO this last test!!!
        $this->card->expects($this->once())
            ->method('isRevealed')
            ->will($this->returnValue(true));

    }

}
