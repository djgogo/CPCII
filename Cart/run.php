<?php
declare(strict_types = 1);

use Cart\Cart;
use Cart\CartItem;
use Cart\EuroFormatter;
use Cart\Money;
use Cart\Repositories\ArticleRepository;

require_once __DIR__ . '/bootstrap.php';

$euroFormatter = new EuroFormatter();
$cart = new Cart();
$articleRepo = new ArticleRepository();

/* articles */
$articleA = $articleRepo->findArticleById(0);
$articleC = $articleRepo->findArticleById(2);
$articleD = $articleRepo->findArticleById(3);
$articleG = $articleRepo->findArticleById(6);

/* create cart-item instance and add some articles to cart */
$cartItem1 = new CartItem('A', new Money($articleA->getPrice()->getAmount() * 2, 'EUR'), $articleA->getPrice(), 2);
$cart->addItem($cartItem1);
printf("\n--> added to Cart: %s : %d x %s Total: %s",
    $cartItem1->getName(),
    $cartItem1->getQuantity(),
    $euroFormatter->format($cartItem1->getUnitPrice()),
    $euroFormatter->format($cartItem1->getPrice())
);

if ($cart->containsArticle($articleA)) {
    $cart->changeQuantity($cartItem1, 4);
} else {
    $cart->addItem($cartItem1);
}

$cartItem2 = new CartItem('C', new Money($articleC->getPrice()->getAmount() * 1, 'EUR'), $articleC->getPrice(), 1);
$cart->addItem($cartItem2);
$cart->addItem($cartItem2);
printf("\n--> added to Cart: %s : %d x %s Total: %s\n",
    $cartItem2->getName(),
    $cartItem2->getQuantity(),
    $euroFormatter->format($cartItem2->getUnitPrice()),
    $euroFormatter->format($cartItem2->getPrice())
);

/* Print out Total-Amount in Cart */
printf("\n                             Total Cart: %s\n", $euroFormatter->format($cart->getTotal()));
