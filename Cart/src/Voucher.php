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

        /**
         * @var string
         */
        private $name;

        /**
         * @var int
         */
        private $id;

        public function __construct(int $id, string $name, int $reduction)
        {
            $this->reduction = $reduction;
            $this->name = $name;
            $this->id = $id;
        }

        public function getReduction() : int
        {
            return $this->reduction;
        }

        public function getId() : int
        {
            return $this->id;
        }

        public function getName() : string
        {
            return $this->name;
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
