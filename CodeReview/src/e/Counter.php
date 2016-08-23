<?php
declare(strict_types = 1);

namespace CodeReview\e
{
    class Counter
    {
        /**
         * @var int
         */
        private $counter = 0;

        public function __construct($initialValue = 0)
        {
            $this->counter = $initialValue;
        }

        public function increment()
        {
            $this->counter++;
        }

        public function getCounter()
        {
            return $this->counter;
        }
    }
}
