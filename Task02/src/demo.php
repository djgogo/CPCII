<?php

require_once 'autoload.php';

$author = new Author("Hans", "Muster", "hans@muster.com");
$book = new Book("Mein Buch", $author, 2016, 160, "Biographie");

printf ("\nAuthor's Email Address: %s\n", $book->getAuthor()->getEmail());