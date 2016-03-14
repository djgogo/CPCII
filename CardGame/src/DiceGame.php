<?php

class DiceGame
{
    /**
     * @var Player[]
     */
    private $players;

    public function __construct()
    {
        $this->gameSetup();
        $this->playGame();
    }

    /**
     * Setup the Game
     */
    public function gameSetup()
    {
        $this->players = array(
            new Player('Alice'),
            new Player('Bob'),
            new Player('Carol')
        );

        foreach ($this->players as $player) {
            $spieler = $player->getName();
            Logger::log(" * Spieler $spieler ist dem Spiel beigetreten");
        }
    }

    /**
     * Play the Game
     */
    public function playGame()
    {
        $gameOver = false;

        while (!$gameOver) {

            foreach ($this->players as $player) {

                $spieler = $player->getName();
                Logger::log("-> $spieler ist am Zug");
                $player->makeMove();

                if ($player->hasAllCardsTurned()) {
                    Logger::log("******> $spieler hat gewonnen! <******");
                    $gameOver = true;
                    break;
                }
            }
        }
    }
}