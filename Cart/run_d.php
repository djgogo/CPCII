<?php
declare(strict_types = 1);

use Cart\Cart;
use Cart\CartItem;
use Cart\EuroFormatter;
use Cart\Money;
use Cart\Renderers\CartAsHtmlTableRenderer;
use Cart\Renderers\HtmlTableRenderer;
use Cart\Repositories\ArticleRepository;
use Cart\Repositories\VoucherRepository;
use Cart\Voucher;

require_once __DIR__ . '/bootstrap.php';

$euroFormatter = new EuroFormatter();
$articleRepo = new ArticleRepository();
$cart = new Cart($articleRepo);
$cart2 = new Cart($articleRepo);
$voucherRepo = new VoucherRepository();
$htmlTableRenderer = new HtmlTableRenderer();
$cartAsHtmlTableRenderer = new CartAsHtmlTableRenderer($htmlTableRenderer, $euroFormatter);

/* articles */
$articleA = $articleRepo->findArticleById(0);
$articleC = $articleRepo->findArticleById(2);
$articleD = $articleRepo->findArticleById(3);
$articleG = $articleRepo->findArticleById(6);

//* create cart-item instance and add some articles to cart1 */
$cartItem1 = new CartItem('A', new Money($articleA->getPrice()->getAmount() * 2, 'EUR'), $articleA->getPrice(), 1);
$cartItem11 = new CartItem('A', new Money($articleA->getPrice()->getAmount() * 2, 'EUR'), $articleA->getPrice(), 1);
$cartItem12 = new CartItem('A', new Money($articleA->getPrice()->getAmount() * 2, 'EUR'), $articleA->getPrice(), 1);
$cartItem13 = new CartItem('A', new Money($articleA->getPrice()->getAmount() * 2, 'EUR'), $articleA->getPrice(), 1);
$cart->addItem($cartItem1);
/* add more Items of the same Article - Merge this Items in Cart1!!!! */
$cart->addItem($cartItem11);
$cart->addItem($cartItem12);
$cart->addItem($cartItem13);

$cartItem2 = new CartItem('C', new Money($articleC->getPrice()->getAmount() * 1, 'EUR'), $articleC->getPrice(), 1);
$cart->addItem($cartItem2);

$cartItem3 = new CartItem('D', new Money($articleD->getPrice()->getAmount() * 2, 'EUR'), $articleD->getPrice(), 2);
$cart->addItem($cartItem3);

/* Add Voucher to Cart1 with 10% Reduction if Article A and D where found in the Cart1 */
$voucher = new Voucher(1, 'Voucher A', 10);
$voucher->setReducedArticle($articleA);
$voucher->setReducedArticle($articleD);

/* Add Voucher to Repo and retrieve it from there */
$voucherRepo->addVoucher($voucher);
$cart->addVoucher($voucherRepo->findVoucherById(1));
//printf("\n--> added to Cart: Voucher : %d%% \n", $voucher->getReduction());

///* Print out Total-Amount in Cart1 */
//printf("\n                             Total Cart: %s\n", $euroFormatter->format($cart->getTotal()));

/* Cart2 */
$cartItem4 = new CartItem('C', new Money($articleC->getPrice()->getAmount() * 1, 'EUR'), $articleC->getPrice(), 1);
$cart2->addItem($cartItem4);

$cartItem5 = new CartItem('G', new Money($articleG->getPrice()->getAmount() * 3, 'EUR'), $articleG->getPrice(), 3);
$cart2->addItem($cartItem5);

/* try to use the voucher a second time! */
$cart2->addVoucher($voucher);

/* Render the whole Cart1 & 2 for HTML View */
$cartAsHtmlTableRenderer->render($cart);
$cartAsHtmlTableRenderer->render($cart2);

/**
 * start following command on the terminal for Browser-View:
 * php -S localhost:8000
 */
echo $htmlTableRenderer->getHtml();
