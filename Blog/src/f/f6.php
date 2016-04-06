<?php

require_once 'autoload.php';

/* create author 1 and his blog */
$author1 = new Author('Bob');
$blog1 = new Blog($author1);
$blog1->setTitle('my first Blog');
printf ("\nAutor %s ist nun mit seinem Blog * %s * aktiv\n", $author1->getName(), $blog1->getTitle());

/* Bob posts on Bob's blog */
$post01 = new Post($author1);
$post01->addHeading('CHECK THIS OUT FRIENDS');
$post01->addBody('Lorem ipsum dolor sit amet, consetetur sadipscing elitr,
sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,
sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.
Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam');
$blog1->addPost($post01);

/* add Alice to Bob's Blog */
$author2 = new Author('Alice');
$blog1->addAuthorToPermissionList($author2);
/* Alice posts on Bobs blog */
$post02 = new Post($author2);
$post02->addHeading('MY GORGEOUS NEW PANTIES');
$post02->addBody('Lorem ipsum dolor sit amet, consetetur sadipscing elitr,
sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,
sed diam voluptua.');
$blog1->addPost($post02);

/* add George to Bob's Blog */
$author3 = new Author('George');
$blog1->addAuthorToPermissionList($author3);
/* George posts on Bobs blog */
$post03 = new Post($author3);
$post03->addHeading('HI BOB - GEORGE HERE');
$post03->addBody('Lorem ipsum dolor sit amet, consetetur sadipscing elitr,
sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,
sed diam voluptua.');
$blog1->addPost($post03);

/* remove Alice from Bob's blog  */
$blog1->removeAuthorFromPermissionList($author2);
/* try to add another post from Alice to bobs blog */
$post04 = new Post($author2);
$post04->addHeading('POST SOME SPAM FROM ALICE');
$post04->addBody('Lorem ipsum dolor sit amet, consetetur sadipscing elitr,
sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,
sed diam voluptua.');
$blog1->addPost($post04);

/* try to remove Bob the owner from permission list */
$blog1->removeAuthorFromPermissionList($author1);

/* add a comment to the blogpost */
$comment01 = new Comment($author3);
$comment01->addCommentText('This is a Comment to the Post01');
$post01->addComment($comment01);

/* add a comment from Alice who actually can't post on the blog but comment posts */
$comment02 = new Comment($author2);
$comment02->addCommentText('Hi this is Alice, Nice Post01. Would like to post something on this blog');
$post01->addComment($comment02);


