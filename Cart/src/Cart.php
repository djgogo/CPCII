<?php
declare(strict_types = 1);

namespace Cart
{
    use Cart\Repositories\ArticleRepository;

    class Cart implements \IteratorAggregate
    {
        /**
         * @var \SplObjectStorage
         */
        private $storage;

        /**
         * @var Voucher
         */
        private $voucher;

        /**
         * @var array
         */
        private $reducedArticles;

        /**
         * @var ArticleRepository
         */
        private $articleRepository;

        public function __construct(ArticleRepository $articleRepository)
        {
            $this->storage = new \SplObjectStorage();
            $this->articleRepository = $articleRepository;
        }

        public function addItem(CartItemInterface $item)
        {
            if ($this->containsArticle($this->articleRepository->findArticleById($item->getId()))) {
                $this->changeQuantity($item, $item->getQuantity());
                return;
            }
            $this->storage->attach($item);
        }

        public function removeItem(CartItemInterface $item)
        {
            $this->storage->detach($item);
        }

        public function containsArticle(ArticleInterface $article) : bool
        {
            $storage = $this->storage;

            $storage->rewind();
            while ($storage->valid()) {
                $object = $storage->current();
                if ($article->getId() === $object->getId()) {
                    $storage->rewind();
                    return true;
                }
                $storage->next();
            }
            return false;
        }

        public function getTotal() : Money
        {
            $totalAmount = 0;

            foreach ($this->storage as $item) {
                $totalAmount += $item->getPrice()->getAmount();
            }

            if (!empty($this->reducedArticles)) {
                foreach ($this->voucher->getReducedArticles() as $reducedArticle) {
                    if ($this->containsArticle($reducedArticle)) {
                        $reduction = round($totalAmount / 100 * $this->voucher->getReduction(), 0);
                        $totalAmount -= $reduction;
                        break;
                    }
                }
            }

            return new Money((int) $totalAmount, Money::CURRENCY_EUR);
        }

        private function changeQuantity(CartItemInterface $item, int $quantity)
        {
            $storage = $this->storage;

            $storage->rewind();
            while ($storage->valid()) {
                $object = $storage->current();
                if ($item->getId() === $object->getId()) {
                    $object->setQuantity($object->getQuantity() + $quantity);
                    $this->calculateNewPrice($object);
                    $storage->rewind();
                }
                $storage->next();
            }
        }

        private function calculateNewPrice($object)
        {
            $object->setPrice(
                new Money($object->getUnitPrice()->getAmount() * $object->getQuantity(), 'EUR')
            );
        }

        public function addVoucher(Voucher $voucher)
        {
            if ($voucher->getStatus() === false) {
                $this->voucher = $voucher;
                if ($voucher->getReducedArticles() != null) {
                    $this->reducedArticles = $voucher->getReducedArticles();
                }
                $this->voucher->setStatus(true);
            }
        }

        public function getVoucher()
        {
            return $this->voucher;
        }

        /**
         * Retrieve an external iterator
         * @link http://php.net/manual/en/iteratoraggregate.getiterator.php
         * @return Traversable An instance of an object implementing <b>Iterator</b> or
         * <b>Traversable</b>
         * @since 5.0.0
         */
        public function getIterator()
        {
            return $this->storage;
        }
    }
}
