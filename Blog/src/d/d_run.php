<?php
declare(strict_types = 1);

require_once 'autoload.php';

/* create author 1 and his blog */
$bob = new Author('Bob');
$blog1 = new Blog($bob);
$blog1->setTitle('my first Blog');
printf("\nAutor %s ist nun mit seinem Blog * %s * aktiv\n", $bob->getName(), $blog1->getTitle());

/* create author 2 */
$alice = new Author('Alice');

/* Bob posts on Bob's blog */
$heading01 = 'CHECK THIS OUT FRIENDS';
$body01 = 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr,
sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,
sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.
Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam';
$post01 = new Post($bob, $heading01, $body01);
try {
    $blog1->addPost($post01);
} catch (BlogException $e) {
    printf("\n****> %s is not authorized to post on this blog - post rejected!!\n", $this->post->getAuthor()->getName());
}

/* add Alice to Bob's Blog */
$blog1->addAuthor($alice);

/* Alice posts on Bobs blog */
$heading02 = 'MY GORGEOUS NEW PANTIES';
$body02 = 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr,
sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,
sed diam voluptua.';
$post02 = new Post($alice, $heading02, $body02);
try {
    $blog1->addPost($post02);
} catch (BlogException $e) {
    printf("\n****> %s is not authorized to post on this blog - post rejected!!\n", $this->post->getAuthor()->getName());
}
