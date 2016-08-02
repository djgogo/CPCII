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
            foreach ($this->storage as $item) {
                $totalAmount += $item->getPrice()->getAmount();
            }
            return new Money($totalAmount, Money::CURRENCY_EUR);
        }

        public function changeQuantity(CartItemInterface $item, int $newQuantity)
        {
            $storage = $this->storage;

            $storage->rewind();
            while ($storage->valid()) {
                $object = $storage->current();
                if ($item->getName() === $object->getName()) {
                    //TODO: missing the right setter for this!!!!!!!!!!!!!!!!!!!!!!
                    $storage->rewind();
                }
                $storage->next();
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
