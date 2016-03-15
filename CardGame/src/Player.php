<?php

class Player
{
    /**
     * @var Card[]
     */
    private $cards;

    /**
     * @var string
     */
    private $name;

    /**
     * @var Dice[]
     */
    private $dice;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Player constructor.
     * @param string $name
     * @param Dice $dice
     * @param LoggerInterface $logger
     */
    public function __construct(string $name, Dice $dice, LoggerInterface $logger)
    {
        $this->name = $name;
        $this->dice = $dice;
        $this->logger = $logger;
    }

    public function addCard(Card $card)
    {
        $this->cards[] = $card;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    public function rollDiceAndTurnMatchingCard()
    {
        $dicedColor = $this->dice->roll();
        $this->logger->log("$this->name hat die Farbe $dicedColor gewürfelt", 'blue');

        foreach($this->cards as $cardNumber => $card) {

            $cardNumber = $cardNumber + 1;
            if ($card->getColor() === $dicedColor) {

                $card->turn();
                $this->logger->log("Yipieee! $this->name's Karte $cardNumber hat die Farbe $dicedColor", 'yellow');
                $this->logger->log("--> Karte $cardNumber wurde umgedreht", 'blue');

            }else {

                if (!$card->isRevealed()) {
                    $this->logger->log("--> Karte $cardNumber ist nicht $dicedColor", 'blue');
                }
            }
        }
    }

    /**
     * @return bool
     */
    public function hasAllCardsTurned()
    {
        $count = 0;
        foreach ($this->cards as $card) {
            if ($card->isRevealed()) {
                $count++;
            }
        }

        return $count === 5;
    }

    public function __toString()
    {
        return $this->name;
    }
}