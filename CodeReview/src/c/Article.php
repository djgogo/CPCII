<?php
declare(strict_types = 1);

namespace CodeReview\c
{
    abstract class Article
    {
        public $id;

//        public function __construct($id)
//        {
//            $this->setId($id);
//        }

        public function setId($id)
        {
            $this->id = $id;
        }

        public function getId()
        {
            return $this->id;
        }
    }
}
