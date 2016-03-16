<?php


class PlayerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Dice
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

    public function setUp()
    {
        $this->name = 'Alice';
        $this->logger = $this->getMock(LoggerInterface::class);
        $this->dice = $this->getMockBuilder(Dice::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->player = new Player($this->name, $this->dice, $this->logger);
    }

    public function testGetName()
    {
        $this->assertEquals($this->name, $this->player->getName());
    }

    public function testRollDiceAndTurnMatchingCardWorks()
    {
        
    }

}
