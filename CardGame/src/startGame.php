<?php
include_once 'autoload.php';

$configuration = new Configuration();

/** Create Echo-Logger and the Game */
$echoLogger = new Logger();
$game = new DiceGame($echoLogger);

/**
 * Validated Objects
 * @var  $colors
 */
$colors = array(
    new Color('Red'),
    new Color('Blue'),
    new Color('Green'),
    new Color('Yellow'),
    new Color('Black'),
    new Color('White')
);

/** Create Dice and Player */
$dice = new Dice($colors);
$player1 = new Player('Alice', $dice, $echoLogger);
$player2 = new Player('Bob', $dice, $echoLogger);
$player3 = new Player('Carole', $dice, $echoLogger);

/**
 * handing out Cards with random colors for each player
 * all 5 cards have different colors
*/
$dice->shuffleColors();
for ($i=0; $i<$configuration->getNumberOfCards(); $i++) {
    $card = new Card($dice->getColor($i));
    $player1->addCard($card);
}
$dice->shuffleColors();
for ($i=0; $i<$configuration->getNumberOfCards(); $i++) {
    $card = new Card($dice->getColor($i));
    $player2->addCard($card);
}
$dice->shuffleColors();
for ($i=0; $i<$configuration->getNumberOfCards(); $i++) {
    $card = new Card($dice->getColor($i));
    $player3->addCard($card);
}

/** Add Players to the Game */
$game->addPlayer($player1);
$game->addPlayer($player2);
$game->addPlayer($player3);

/** Play the Game */
$game->playGame();