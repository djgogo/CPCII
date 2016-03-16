<?php

/**
 * @covers DiceGame
 * @uses LoggerInterface
 */
class DiceGameTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var DiceGame
     */
    private $diceGame;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $logger;

    public function setUp()
    {
        $this->logger = $this->getMock(LoggerInterface::class);
        $this->diceGame = new DiceGame($this->logger);
    }

    public function testAddPlayerDoesALogCall()
    {
        $player = $this->getMockBuilder(Player::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->logger
            ->expects($this->once())
            ->method('log');

        $this->diceGame->addPlayer($player);
    }

    public function testPlayGameWorks()
    {
        $player = $this->getMockBuilder(Player::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->diceGame->addPlayer($player);

        $player->expects($this->once())
            ->method('rollDiceAndTurnMatchingCard');

        $player
            ->expects($this->once())
            ->method('hasAllCardsTurned')
            ->will($this->returnValue(true));

        $this->diceGame->playGame();
    }

    public function testPlayGameWithTwoPlayersWorks()
    {
        $player1 = $this->getMockBuilder(Player::class)
            ->disableOriginalConstructor()
            ->getMock();

        $player2 = $this->getMockBuilder(Player::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->diceGame->addPlayer($player1);
        $this->diceGame->addPlayer($player2);

        $player1
            ->expects($this->once())
            ->method('rollDiceAndTurnMatchingCard');

        $player1
            ->expects($this->once())
            ->method('hasAllCardsTurned')
            ->will($this->returnValue(false));

        $player2
            ->expects($this->once())
            ->method('rollDiceAndTurnMatchingCard');

        $player2
            ->expects($this->once())
            ->method('hasAllCardsTurned')
            ->will($this->returnValue(true));

        $this->diceGame->playGame();
    }
}
