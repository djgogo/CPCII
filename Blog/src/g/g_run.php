<?php
declare(strict_types = 1);

require_once 'autoload.php';

/* create author 1 and his blog */
$bob = new Author('Bob');
$blog1 = new Blog($bob);
$blog1->setTitle('my first Blog');
printf ("\nAutor %s ist nun mit seinem Blog * %s * aktiv\n", $bob->getName(), $blog1->getTitle());

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
    printf("\n****> %s is not authorized to post on this blog - post rejected!!\n", $post01->getAuthor()->getName());
}

/* add Alice to Bob's Blog */
$alice = new Author('Alice');
$blog1->addAuthorToPermissionList($alice);
/* Alice posts on Bobs blog */
$heading02 = 'MY GORGEOUS NEW PANTIES';
$body02 = 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr,
sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,
sed diam voluptua.';
$post02 = new Post($alice, $heading02, $body02);
try {
    $blog1->addPost($post02);
} catch (BlogException $e) {
    printf("\n****> %s is not authorized to post on this blog - post rejected!!\n", $post02->getAuthor()->getName());
}

/* add George to Bob's Blog */
$george = new Author('George');
$blog1->addAuthorToPermissionList($george);
/* George posts on Bobs blog */
$heading03 = 'HI BOB - GEORGE HERE';
$body03 = 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr,
sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,
sed diam voluptua.';
$post03 = new Post($george, $heading03, $body03);
try {
    $blog1->addPost($post03);
} catch (BlogException $e) {
    printf("\n****> %s is not authorized to post on this blog - post rejected!!\n", $post03->getAuthor()->getName());
}

/* remove Alice from Bob's blog  */
$blog1->removeAuthorFromPermissionList($alice);
/* try to add another post from Alice to bobs blog */
try {
    $blog1->addPost($post02);
} catch (BlogException $e) {
    printf("\n****> %s is not authorized to post on this blog - post rejected!!\n", $post02->getAuthor()->getName());
}

/* try to remove Bob the owner from permission list */
try {
    $blog1->removeAuthorFromPermissionList($bob);
} catch (RemovePermissionException $e) {
    printf("\n****> %s is the owner of this blog - removing rejected!!\n", $bob->getName());
} catch (PermissionNotFoundException $e) {
    printf("\n****> %s is not in the permission list - removing rejected!!\n", $bob->getName());
}

/* try to remove Steve which has no Permission on Bobs Blog! Exception */
$Steve = new Author('Steve');
try {
    $blog1->removeAuthorFromPermissionList($Steve);
} catch (RemovePermissionException $e) {
    printf("\n****> %s is the owner of this blog - removing rejected!!\n", $steve->getName());
} catch (PermissionNotFoundException $e) {
    printf("\n****> %s is not in the permission list - removing rejected!!\n", $Steve->getName());
}

/* add a comment to the blogpost */
$comment01 = 'This is a Comment on Bobs Post01';
$commentFromGeorge = new Comment($george, $comment01);
$post01->addComment($commentFromGeorge);

/* add a comment from Alice who actually can't post on the blog but comment posts */
$comment02 = 'Hi Bob, Alice here, Nice Post01. Would like to post something on your blog';
$commentFromAlice = new Comment($alice, $comment02);
$post01->addComment($commentFromAlice);

/* add a comment to the post03 */
$commentComment01 = 'Hi George, this is Bob - I do not agree with your post';
$commentFromBob = new Comment($bob, $commentComment01);
$post03->addComment($commentFromBob);

/* add comment to the comment03 of Bob */
$commentComment02 = 'Hi Bob this is George - actually i dont care if you do not agree';
$commentFromGeorge = new Comment($george, $commentComment02);
$commentFromGeorge->addComment($commentFromGeorge);

