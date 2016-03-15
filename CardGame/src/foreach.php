<?php

$demo = array(
    'Peter' => array(
        'Rot',
        'Blau',
        'Grün'
    ),
    'Flo' => array(
        'Gelb',
        'Grün',
        'Orange'
    )
);

foreach ($demo as $name => $farben) {
    echo $name.' hat folgende Farben:';
    foreach ($farben as $farbe) {
        echo $farbe.', ';
    }
    echo PHP_EOL;
}