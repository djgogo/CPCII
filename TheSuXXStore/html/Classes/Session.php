<?php

class SuxxSession
{
    /**
     * @var array
     */
    public $session;

    public function __construct(Array $session)
    {
        $this->session = $session;
    }

    public function setValue($key, $value)
    {
        $this->session[$key] = $value;
    }

    public function getValue($key, $default = null)
    {
        if (isset($this->session[$key])) {
            return $this->escape($this->session[$key]);
        }
        return $default;
    }

    public function isset($key) : bool
    {
        return isset($this->session[$key]);
    }

    private function escape($string) : string
    {
        return htmlspecialchars($string, ENT_QUOTES);
    }
}
