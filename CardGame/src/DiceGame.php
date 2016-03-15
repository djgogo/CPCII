<?php

class DiceGame
{
    /**
     * @var Player[]
     */
    private $players;
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * DiceGame constructor.
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }


    public function addPlayer(Player $player)
    {
        $this->players[] = $player;
        $this->logger->log(" * Spieler $player ist dem Spiel beigetreten", 'yellow');
    }

    public function playGame()
    {
        $gameOver = false;

        while (!$gameOver) {

            foreach ($this->players as $player) {

                $this->logger->log("-> $player ist am Zug", 'white');
                $player->rollDiceAndTurnMatchingCard();

                if ($player->hasAllCardsTurned()) {
                    $this->logger->log("**************************************", "red");
                    $this->logger->log("******> $player hat gewonnen! <******", "red");
                    $this->logger->log("**************************************", "red");
                    $gameOver = true;
                    break;
                }
            }
        }
    }
}