<?php

namespace Suxx\Http {

    use Suxx\Entities\Product;
    use Suxx\Exceptions\ResponseException;

    class Response
    {
        /**
         * @var array
         */
        private $data = array();

        /**
         * @var array
         */
        private $products;

        /**
         * @var Product
         */
        private $product;

        /**
         * @var array
         */
        private $comments;

        /**
         * @var string
         */
        private $redirect;

        public function setValue($key, $value)
        {
            $this->data[$key] = $value;
        }

        public function getValue(string $key) : string
        {
            if (!isset($this->data[$key])) {
                throw new ResponseException("Key '$key' does not exist");
            }
            return $this->data[$key];
        }

        public function isset(string $key) : bool
        {
            return isset($this->data[$key]);
        }

        public function getProduct() : Product
        {
            return $this->product;
        }

        public function setProduct(Product $product)
        {
            $this->product = $product;
        }

        public function getProducts() : array
        {
            return $this->products;
        }

        public function setProducts(array $products)
        {
            $this->products = $products;
        }

        public function getComments() : array
        {
            return $this->comments;
        }

        public function setComments(array $comments)
        {
            $this->comments = $comments;
        }

        public function setRedirect(string $path)
        {
            $this->redirect = $path;
        }

        public function getRedirect() : string
        {
            return $this->redirect;
        }

        public function hasRedirect() : bool
        {
            return isset($this->redirect);
        }
    }
}
