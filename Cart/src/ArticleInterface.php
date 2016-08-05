<?php
declare(strict_types = 1);

namespace Cart
{
    interface ArticleInterface
    {
        public function getName();
        public function getPrice();
    }
}
