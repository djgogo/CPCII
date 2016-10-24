<?php

class SuxxRequest
{
    /**
     * @var array
     */
    public $input;

    /**
     * @var array
     */
    public $params;

    public function __construct(Array $request)
    {
        $this->input = $request;
    }

    public function getRequestUri() : string
    {
        return $_SERVER['REQUEST_URI'];
    }

    public function setParams(Array $params)
    {
        $this->params = $params;
    }

    public function getValue($key, $default = null)
    {
        if (isset($this->input[$key])) {
            return $this->escape($this->input[$key]);
        }

        if (isset($this->params[$key])) {
            return $this->escape($this->params[$key]);
        }

        return $default;
    }

    private function escape($string) : string
    {
        return htmlspecialchars($string, ENT_QUOTES);
    }
}
