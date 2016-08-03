<?php
declare(strict_types = 1);

use Cart\Cart;
use Cart\CartItem;
use Cart\EuroFormatter;
use Cart\Money;
use Cart\Renderers\CartAsHtmlTableRenderer;
use Cart\Renderers\HtmlTableRenderer;
use Cart\Repositories\ArticleRepository;

require_once __DIR__ . '/bootstrap.php';

$euroFormatter = new EuroFormatter();
$cart = new Cart();
$articleRepo = new ArticleRepository();
$htmlTableRenderer = new HtmlTableRenderer();
$cartAsHtmlTableRenderer = new CartAsHtmlTableRenderer();

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
$cartAsHtmlTableRenderer->renderRow(
    $cartItem1->getName(),
    (string) $cartItem1->getQuantity(),
    $euroFormatter->format($cartItem1->getUnitPrice()),
    $euroFormatter->format($cartItem1->getPrice())
);

$cartItem2 = new CartItem('C', new Money($articleC->getPrice()->getAmount() * 1, 'EUR'), $articleC->getPrice(), 1);
$cart->addItem($cartItem2);
$cartAsHtmlTableRenderer->renderRow(
    $cartItem2->getName(),
    (string) $cartItem2->getQuantity(),
    $euroFormatter->format($cartItem2->getUnitPrice()),
    $euroFormatter->format($cartItem2->getPrice())
);

$cartItem3 = new CartItem('D', new Money($articleD->getPrice()->getAmount() * 2, 'EUR'), $articleD->getPrice(), 2);
$cart->addItem($cartItem3);
$cartAsHtmlTableRenderer->renderRow(
    $cartItem3->getName(),
    (string) $cartItem3->getQuantity(),
    $euroFormatter->format($cartItem3->getUnitPrice()),
    $euroFormatter->format($cartItem3->getPrice())
);

/* Print out Total-Amount in Cart */
$cartAsHtmlTableRenderer->renderTotal(
    $euroFormatter->format($cart->getTotal())
);
echo $cartAsHtmlTableRenderer->getHtml();
