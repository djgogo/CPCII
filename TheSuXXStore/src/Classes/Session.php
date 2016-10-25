<?php

class SuxxSession
{
    /**
     * @var array
     */
    public $session;

    public function __construct(array $session)
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

    public function getSessionData() : array
    {
        return $this->session;
    }

    public function isset($key) : bool
    {
        return isset($this->session[$key]);
    }

    private function escape($string) : string
    {
        return htmlspecialchars($string, ENT_QUOTES);
    }

    public function commit()
    {
        var_dump($_SESSION);
        var_dump($this->getSessionData());
        $_SESSION = $this->getSessionData();
    }
}
