<?php

class User
{

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $realName;

    /**
     * @var string
     */
    private $screenName;

    public function __construct($id, $realName, $email)
    {
        $this->id = $id;
        $this->realName = $this->escape($realName);
        $this->email = $this->escape($email);
    }

    public function getId()
    {
        return $this->id;
    }

    public function setEmail($email)
    {
        $this->email = $this->escape($email);
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getRealName()
    {
        return $this->realName;
    }

    /**
     * @param string $screenName
     */
    public function setScreenName($screenName)
    {
        $this->screenName = $this->escape($screenName);
    }

    public function getScreenName()
    {
        if ($this->screenName == NULL) {
            return $this->realName;
        }
        return $this->screenName;
    }

    private function escape($string) : string
    {
        return htmlspecialchars($string, ENT_QUOTES);
    }
}
