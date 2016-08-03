<?php
declare(strict_types = 1);

namespace Cart
{
    use Traversable;

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

        public function __construct()
        {
            $this->storage = new \SplObjectStorage();
        }

        public function addItem(CartItemInterface $item)
        {
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
                if ($article->getName() === $object->getName()) {
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
            static $taken = null;

            foreach ($this->storage as $item) {
                $totalAmount += $item->getPrice()->getAmount();
            }

            if (!empty($this->reducedArticles && $taken === null)) {
                foreach ($this->voucher->getReducedArticles() as $reducedArticle) {
                    if ($this->containsArticle($reducedArticle)) {
                        $reduction = round($totalAmount / 100 * $this->voucher->getReduction(), 0);
                        $totalAmount -= $reduction;
                        $taken = 'already used';
                        break;
                    }
                }
            }

            return new Money((int) $totalAmount, Money::CURRENCY_EUR);
        }

        public function changeQuantity(CartItemInterface $item, int $newQuantity)
        {
            $storage = $this->storage;

            $storage->rewind();
            while ($storage->valid()) {
                $object = $storage->current();
                if ($item->getName() === $object->getName()) {
                    $object->setQuantity($newQuantity);
                    $storage->rewind();
                }
                $storage->next();
            }
        }

        public function addVoucher(Voucher $voucher)
        {
            $this->voucher = $voucher;
            if ($voucher->getReducedArticles() != null) {
                $this->reducedArticles = $voucher->getReducedArticles();
            }
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
            return new \ArrayIterator($this->storage);
        }
    }
}
