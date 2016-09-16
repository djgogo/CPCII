<?php
declare(strict_types = 1);

use CodeReview\c\SpecialArticle;

require_once __DIR__ . '/bootstrap.php';

$article = new SpecialArticle(234690);
//$article->setId(234690);

var_dump($article->getId());
