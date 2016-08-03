<?php
declare(strict_types = 1);

use Cart\Cart;
use Cart\CartItem;
use Cart\EuroFormatter;
use Cart\Money;
use Cart\Repositories\ArticleRepository;
use Cart\Voucher;

require_once __DIR__ . '/bootstrap.php';

$euroFormatter = new EuroFormatter();
$cart = new Cart();
$cart2 = new Cart();
$articleRepo = new ArticleRepository();

/* articles */
$articleA = $articleRepo->findArticleById(0);
$articleC = $articleRepo->findArticleById(2);
$articleD = $articleRepo->findArticleById(3);
$articleG = $articleRepo->findArticleById(6);

/* create cart-item instance and add some articles to cart */
$cartItem1 = new CartItem('A', new Money($articleA->getPrice()->getAmount() * 2, 'EUR'), $articleA->getPrice(), 2);
$cart->addItem($cartItem1);
if ($cart->containsArticle($articleA)) {
    $cart->changeQuantity($cartItem1, 4);
    $cartItem1->setPrice(new Money($articleA->getPrice()->getAmount() * 4, 'EUR'));
} else {
    $cart->addItem($cartItem1);
}
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

/* Add Voucher to Cart1 with 10% Reduction if Article A and D are in the Cart */
$voucher = new Voucher(10);
$voucher->setReducedArticle($articleA);
$voucher->setReducedArticle($articleD);
$cart->addVoucher($voucher);
printf("\n--> added to Cart: Voucher : %d%% \n", $voucher->getReduction());

/* Print out Total-Amount in Cart1 */
printf("\n                             Total Cart: %s\n", $euroFormatter->format($cart->getTotal()));

$cartItem4 = new CartItem('C', new Money($articleC->getPrice()->getAmount() * 1, 'EUR'), $articleC->getPrice(), 1);
$cart2->addItem($cartItem4);
printf("\n--> added to Cart: %s : %d x %s Total: %s",
    $cartItem4->getName(),
    $cartItem4->getQuantity(),
    $euroFormatter->format($cartItem4->getUnitPrice()),
    $euroFormatter->format($cartItem4->getPrice())
);

$cartItem5 = new CartItem('G', new Money($articleG->getPrice()->getAmount() * 3, 'EUR'), $articleG->getPrice(), 3);
$cart2->addItem($cartItem5);
printf("\n--> added to Cart: %s : %d x %s Total: %s\n",
    $cartItem5->getName(),
    $cartItem5->getQuantity(),
    $euroFormatter->format($cartItem5->getUnitPrice()),
    $euroFormatter->format($cartItem5->getPrice())
);

/* try to use the voucher a second time! */
$cart2->addVoucher($voucher);
/* Print out Total-Amount in Cart2 */
printf("\n                             Total Cart: %s\n", $euroFormatter->format($cart2->getTotal()));
