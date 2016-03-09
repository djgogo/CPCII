<?php

require_once 'autoload.php';



// Catch exception if email is invalid and print error message
try {

    $author = new Author("Hans", "Muster", "hans@muster.com");
    $book = new Book("Mein Buch", $author, 2016, 160, "Biographie");

    printf ("\nAuthor's Email Address: %s\n", $book->getAuthor()->getEmail());

}catch (\Exception $e) {
    printf("\nInvalid Email Address!");
}
