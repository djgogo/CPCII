<?php
include 'Color.php';

$red = new Color('Red');

$anotherRed = $red;

$newRed = new Color('Red');

var_dump($red === $anotherRed);