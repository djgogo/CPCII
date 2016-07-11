<?php
declare(strict_types = 1);

require_once 'autoload.php';

/* create author 1 and his blog */
$author1 = new Author('Bob');
$blog1 = new Blog($author1);
$blog1->setTitle('my first Blog');
printf ("\nAutor %s ist nun mit seinem Blog * %s * aktiv\n", $author1->getName(), $blog1->getTitle());

/* create author 2 and his blog */
$author2 = new Author('Alice');
$blog2 = new Blog($author2);
$blog2->setTitle('my lovely blog');
printf ("\nAutor %s ist nun mit Ihrem Blog * %s * aktiv\n", $author2->getName(), $blog2->getTitle());

/* create post for Bob's blog */
$post01 = new Post($author1);
$post01->addHeading('CHECK THIS OUT FRIENDS');
$post01->addBody('Lorem ipsum dolor sit amet, consetetur sadipscing elitr,
sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,
sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.
Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam');
$blog1->addPost($post01);

/* create post for Alice's blog */
$post02 = new Post($author2);
$post02->addHeading('MY GORGEOUS NEW PANTIES');
$post02->addBody('Lorem ipsum dolor sit amet, consetetur sadipscing elitr,
sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,
sed diam voluptua.');
$blog2->addPost($post02);

/* create post for Bob's blog and try to post it on Alices Blog */
$post03 = new Post($author1);
$post03->addHeading('SPAM POST');
$post03->addBody('Lorem ipsum dolor sit amet, consetetur sadipscing elitr,
sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,
sed diam voluptua.');
$blog2->addPost($post03);

