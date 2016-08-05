<?php
declare(strict_types = 1);

use Cart\Cart;
use Cart\CartItem;
use Cart\EuroFormatter;
use Cart\Money;
use Cart\Repositories\ArticleRepository;

require_once __DIR__ . '/bootstrap.php';

$euroFormatter = new EuroFormatter();
$articleRepo = new ArticleRepository();
$cart = new Cart($articleRepo);

/* articles */
$articleA = $articleRepo->findArticleById(0);
$articleC = $articleRepo->findArticleById(2);
$articleD = $articleRepo->findArticleById(3);
$articleG = $articleRepo->findArticleById(6);

/* create cart-item instance and add some articles to cart */
$cartItem1 = new CartItem('A', new Money($articleA->getPrice()->getAmount() * 2, 'EUR'), $articleA->getPrice(), 1);
$cartItem11 = new CartItem('A', new Money($articleA->getPrice()->getAmount() * 2, 'EUR'), $articleA->getPrice(), 1);
$cartItem12 = new CartItem('A', new Money($articleA->getPrice()->getAmount() * 2, 'EUR'), $articleA->getPrice(), 1);
$cartItem13 = new CartItem('A', new Money($articleA->getPrice()->getAmount() * 2, 'EUR'), $articleA->getPrice(), 1);
$cart->addItem($cartItem1);
/* add more Items of the same Article - Merge this Items in Cart!!!! */
$cart->addItem($cartItem11);
$cart->addItem($cartItem12);
$cart->addItem($cartItem13);

printf("\n--> added to Cart: %s : %d x %s Total: %s",
    $cartItem1->getName(),
    $cartItem1->getQuantity(),
    $euroFormatter->format($cartItem1->getUnitPrice()),
    $euroFormatter->format($cartItem1->getPrice())
);

$cartItem2 = new CartItem('C', new Money($articleC->getPrice()->getAmount() * 1, 'EUR'), $articleC->getPrice(), 1);
$cart->addItem($cartItem2);
printf("\n--> added to Cart: %s : %d x %s Total: %s",
    $cartItem2->getName(),
    $cartItem2->getQuantity(),
    $euroFormatter->format($cartItem2->getUnitPrice()),
    $euroFormatter->format($cartItem2->getPrice())
);

$cartItem3 = new CartItem('D', new Money($articleD->getPrice()->getAmount() * 2, 'EUR'), $articleD->getPrice(), 2);
$cart->addItem($cartItem3);
printf("\n--> added to Cart: %s : %d x %s Total: %s\n",
    $cartItem3->getName(),
    $cartItem3->getQuantity(),
    $euroFormatter->format($cartItem3->getUnitPrice()),
    $euroFormatter->format($cartItem3->getPrice())
);

/* Print out Total-Amount in Cart */
printf("\n                             Total Cart: %s\n", $euroFormatter->format($cart->getTotal()));

