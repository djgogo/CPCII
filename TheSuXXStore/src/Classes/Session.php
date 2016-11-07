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

    public function setValue(string $key, $value)
    {
        $this->session[$key] = $value;
    }

    public function getValue(string $key, $default = null)
    {
        if (isset($this->session[$key])) {
            return $this->session[$key];
        }
        return $default;
    }

    public function deleteValue(string $key)
    {
        if (isset($this->session[$key])) {
            unset($this->session[$key]);
        }
    }

    public function getSessionData() : array
    {
        if ($this->session !== null) {
            return $this->session;
        }
        return array();
    }

    public function isset(string $key) : bool
    {
        return isset($this->session[$key]);
    }
}
