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

    /**
     * @var string
     */
    private $redirect;

    public function __set($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function __get($key)
    {
        if (!isset($this->data[$key])) {
            throw new SuxxResponseException("Key '$key' does not exist");
        }
        return $this->escape($this->data[$key]);
    }

    public function __isset($key)
    {
        return isset($this->data[$key]);
    }

    public function setRedirect($path)
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

    private function escape($string) : string
    {
        return htmlspecialchars($string, ENT_QUOTES);
    }
}
