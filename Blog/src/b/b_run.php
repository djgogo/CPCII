<?php
declare(strict_types = 1);

require_once 'autoload.php';

/* create author and his blog */
$author = new Author('Bob');
$blog = new Blog($author);
$blog->setTitle('my first Blog');
printf ("\nAutor %s ist nun mit seinem Blog * %s * aktiv\n", $author->getName(), $blog->getTitle());

/* create a first post */
$post01 = new Post($author);
$post01->addHeading('CHECK THIS OUT FRIENDS');
$post01->addBody('Lorem ipsum dolor sit amet, consetetur sadipscing elitr,
sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,
sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.
Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam');
printf ("\n-- %s", $post01->getHeading());
printf ("\n%s\n", $post01->getBody());



