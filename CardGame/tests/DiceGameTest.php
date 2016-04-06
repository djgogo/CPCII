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
        // create a mock Player
        $player = $this->getMockBuilder(Player::class)
            ->disableOriginalConstructor()
            ->getMock();

        // add the mock to the DiceGame
        $this->diceGame->addPlayer($player);

        // make sure method rollDiceAndTurnMatchingCard is called
        $player->expects($this->once())
            ->method('rollDiceAndTurnMatchingCard');

        // make method hasAllCardsTurned return true
        $player
            ->expects($this->once())
            ->method('hasAllCardsTurned')
            ->will($this->returnValue(true));

        // EXECUTE method
        $this->diceGame->playGame();
    }

    public function testPlayGameWithTwoPlayersWorks()
    {
        // create mock Player1
        $player1 = $this->getMockBuilder(Player::class)
            ->disableOriginalConstructor()
            ->getMock();

        // create mock Player2
        $player2 = $this->getMockBuilder(Player::class)
            ->disableOriginalConstructor()
            ->getMock();

        // add both mocks to the DiceGame
        $this->diceGame->addPlayer($player1);
        $this->diceGame->addPlayer($player2);

        // make sure method rollDiceAndTurnMatchingCard is called
        $player1
            ->expects($this->once())
            ->method('rollDiceAndTurnMatchingCard');

        // make method hasAllCardsTurned return false
        $player1
            ->expects($this->once())
            ->method('hasAllCardsTurned')
            ->will($this->returnValue(false));

        // make sure method rollDiceAndTurnMatchingCard is called
        $player2
            ->expects($this->once())
            ->method('rollDiceAndTurnMatchingCard');

        // make method hasAllCardsTurned return true
        $player2
            ->expects($this->once())
            ->method('hasAllCardsTurned')
            ->will($this->returnValue(true));

        $this->diceGame->playGame();
    }
}
