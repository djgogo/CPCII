<?php
declare(strict_types = 1);

namespace Cart\Repositories
{
    use Cart\Article;
    use Cart\Money;

    class ArticleRepository implements ArticleRepositoryInterface
    {
        private $articleData = [
            0 => ['A', 990,  Money::CURRENCY_EUR],
            1 => ['B', 2990, Money::CURRENCY_EUR],
            2 => ['C', 1990, Money::CURRENCY_EUR],
            3 => ['D', 99,   Money::CURRENCY_EUR],
            4 => ['E', 3990, Money::CURRENCY_EUR],
            5 => ['F', 990,  Money::CURRENCY_EUR],
            6 => ['G', 1990, Money::CURRENCY_EUR],
            7 => ['H', 1290, Money::CURRENCY_EUR],
            8 => ['I', 490,  Money::CURRENCY_EUR],
            9 => ['J', 1490, Money::CURRENCY_EUR]
        ];

        private $articles = [];

        public function findArticleById(int $id) : Article
        {
            if (!isset($this->articles[$id])) {
                $this->articles[$id] = new Article(
                    $id,
                    $this->articleData[$id][0],
                    new Money(
                        $this->articleData[$id][1],
                        $this->articleData[$id][2]
                    )
                );
            }
            return $this->articles[$id];
        }
    }
}
