<?php
include_once 'autoload.php';

$numCards = 5;

$configuration = new Configuration();
// Create Echo-Logger and the Game
$echoLogger = new Logger();
$game = new DiceGame($echoLogger);

// Validated Colors
$colors = array(
    new Color('Red'),
    new Color('Blue'),
    new Color('Green'),
    new Color('Yellow'),
    new Color('Black'),
    new Color('White')
);

// Create Dice and Player
$dice = new Dice($colors);
$player1 = new Player('Alice', $dice, $echoLogger);
$player2 = new Player('Bob', $dice, $echoLogger);
$player3 = new Player('Carole', $dice, $echoLogger);

// handing out Cards with random colors for each player

for ($i=0; $i<$configuration->getNumberOfCards(); $i++) {
    $card = new Card($dice->roll());
    $player1->addCard($card);
}
for ($i=0; $i<$configuration->getNumberOfCards(); $i++) {
    $card = new Card($dice->roll());
    $player2->addCard($card);
}
for ($i=0; $i<$configuration->getNumberOfCards(); $i++) {
    $card = new Card($dice->roll());
    $player3->addCard($card);
}

// Add Players to the Game
$game->addPlayer($player1);
$game->addPlayer($player2);
$game->addPlayer($player3);

// Setup and play the Game
$game->playGame();