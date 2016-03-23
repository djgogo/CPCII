<?php

require_once 'autoload.php';

/* create author and his blog */
$author = new Author('Bob');
$blog = new Blog($author);
$blog->setTitle('my first Blog');
printf ("\nAutor %s ist nun mit seinem Blog * %s * aktiv\n", $author->getName(), $blog->getTitle());
