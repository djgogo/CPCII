<?php
declare(strict_types = 1);

namespace CodeReview\c {

    class SpecialArticle extends Article
    {
        public $id;

//        public function __construct($id)
//        {
//            parent::__construct($id);
//            $this->setId($id);
//        }

        public function setId($id)
        {
            if ($id <= 100000) {
                throw new ArticleException(
                    'ID must be greater than 100000'
                );
            }

            $this->id = $id;
        }
    }
}
