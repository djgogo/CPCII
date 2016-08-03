<?php
declare(strict_types = 1);

namespace Cart
{
    class Voucher
    {
        /**
         * @var int
         */
        private $reduction;

        /**
         * @var array
         */
        private $reducedArticles;

        public function __construct(int $reduction)
        {
            $this->reduction = $reduction;
        }

        public function getReduction() : int
        {
            return $this->reduction;
        }

        public function setReducedArticle(Article $article)
        {
            $this->reducedArticles[] = $article;
        }

        public function getReducedArticles() : array
        {
            return $this->reducedArticles;
        }
    }
}
