<?php

class SuxxResponse
{
    /**
     * @var array
     */
    protected $data = array();

    /**
     * @var object
     */
    public $products;

    /**
     * @var object
     */
    public $product;

    /**
     * @var object
     */
    public $comments;

    public function __set($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function __get($key)
    {
        if (!isset($this->data[$key])) {
            throw new SuxxResponseException("Key '$key' does not exist");
        }
        return $this->data[$key];
    }

    public function __isset($key)
    {
        return isset($this->data[$key]);
    }

}
