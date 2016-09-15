<?php
declare(strict_types = 1);

require_once 'autoload.php';

/* create author 1 and his blog */
$bob = new Author('Bob');
$blog1 = new Blog($bob);
$blog1->setTitle('my first Blog');
printf("\nAutor %s ist nun mit seinem Blog * %s * aktiv\n", $bob->getName(), $blog1->getTitle());

/* create author 2 and his blog */
$alice = new Author('Alice');
$blog2 = new Blog($alice);
$blog2->setTitle('my lovely blog');
printf("\nAutor %s ist nun mit Ihrem Blog * %s * aktiv\n", $alice->getName(), $blog2->getTitle());

/* create post for Bob's blog */
$heading01 = 'CHECK THIS OUT FRIENDS';
$body01 = 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr,
sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,
sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.
Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam';
$post01 = new Post($bob, $heading01, $body01);
$blog1->addPost($post01);

/* create post for Alice's blog */
$heading02 = 'MY GORGEOUS NEW PANTIES';
$body02 = 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr,
sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,
sed diam voluptua.';
$post02 = new Post($alice, $heading02, $body02);
$blog2->addPost($post02);

/* create post for Bob's blog and try to post it on Alices Blog */
$heading03 = 'SPAM POST';
$body03 = 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr,
sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,
sed diam voluptua.';
$post03 = new Post($bob, $heading03, $body03);
try {
    $blog2->addPost($post03);
} catch (BlogException $e) {
    printf("\n******** %s is not the owner of this blog - post rejected!!\n", $alice->getName());
}


