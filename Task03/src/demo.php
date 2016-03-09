<?php

require_once 'autoload.php';

$circle = new Circle(6);
$rectangle = new Rectangle(12,20);
$square = new Square(40);

// Circle
printf("\n");
printf("Circles Scope: %f\n", $circle->getScope());
printf("Circles Diagonal: %f\n", $circle->getDiagonal());
printf("Circles Aera: %f\n", $circle->getArea());
printf("\n");

// Rectangle
printf("\n");
printf("Rectangles Scope: %f\n", $rectangle->getScope());
printf("Rectangles Diagonal: %f\n", $rectangle->getDiagonal());
printf("Rectangles Aera: %f\n", $rectangle->getArea());
printf("\n");

// Square
printf("\n");
printf("Squares Scope: %f\n", $square->getScope());
printf("Squares Diagonal: %f\n", $square->getDiagonal());
printf("Squares Aera: %f\n", $square->getArea());
printf("\n");