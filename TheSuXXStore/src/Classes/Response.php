<?php

class SuxxResponse
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
     * @var SuxxProduct
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

    public function getValue(string $key)
    {
        if (!isset($this->data[$key])) {
            throw new SuxxResponseException("Key '$key' does not exist");
        }
        return $this->escape($this->data[$key]);
    }

    public function isset(string $key)
    {
        return isset($this->data[$key]);
    }

    public function getProduct() : SuxxProduct
    {
        return $this->product;
    }

    public function setProduct(SuxxProduct $product)
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

    private function escape(string $string) : string
    {
        return htmlspecialchars($string, ENT_QUOTES);
    }
}
