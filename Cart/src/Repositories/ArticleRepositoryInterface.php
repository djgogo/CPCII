<?php
declare(strict_types = 1);

namespace Cart\Repositories
{
    interface ArticleRepositoryInterface
    {
        public function findArticleById(int $id);
    }
}
