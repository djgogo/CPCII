<?php
declare(strict_types = 1);

require_once 'autoload.php';

/* create author and his blog */
$author = new Author('Bob');
$blog = new Blog($author);
$blog->setTitle('my first Blog');
printf("\nAutor %s ist nun mit seinem Blog * %s * online\n", $author->getName(), $blog->getTitle());

/* create a first post */
$heading01 = 'CHECK THIS OUT FRIENDS - my first Post';
$body01 = 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr,
sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,
sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.
Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam';
$post01 = new Post($author, $heading01, $body01);
$blog->addPost($post01);

$heading02 = 'CHECK THIS OUT FRIENDS - my second Post';
$body02 = 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr,
sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,';
$post02 = new Post($author, $heading02, $body02);
$blog->addPost($post02);
