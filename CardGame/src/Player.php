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
     * Player constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;

        $dice = new Dice();
        $this->cards = array(
            new Card($dice->roll()),
            new Card($dice->roll()),
            new Card($dice->roll()),
            new Card($dice->roll()),
            new Card($dice->roll())
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * roll the dice and check if diced color matches one of the cards
     * if yes turn the card
     */
    public function makeMove()
    {
        $dice = new Dice();
        $dicedColor = $dice->roll();
        Logger::log("$this->name hat die Farbe $dicedColor gewürfelt");

        for ($i=0; $i<5; $i++) {

            if ($this->cards[$i]->getColor() == $dicedColor) {

                $this->cards[$i]->turn();
                $cardNumber = $i+1;
                Logger::log("Yipieee! $this->name's Karte $cardNumber hat die Farbe $dicedColor");
                Logger::log("--> Karte $cardNumber wurde umgedreht");

            }else {

                if (!$this->cards[$i]->isRevealed()) {
                    $cardNumber = $i + 1;
                    Logger::log("--> Karte $cardNumber ist nicht $dicedColor");
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

        if ($count == 5) {
            return true;
        }else {
            return false;
        }
    }
}