<?php


class User
{
    /**
     * @var integer
     */
    private $id;
    /**
     * @var string
     */
    private $realName;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $screenName = null;

    /**
     * a1 constructor.
     * @param int $id
     * @param string $realName
     * @param string $email
     */
    public function __construct(int $id, string $realName, string $email)
    {
        $this->id = $id;
        $this->realName = $realName;
        $this->email = $email;
    }

    public function getUserId():int
    {
        return $this->id;
    }

    public function getRealName():string
    {
        return $this->realName;
    }

    public function getEmail():string
    {
        return $this->email;
    }

    public function getScreenName():string
    {
        if ($this->screenName != null) {
            return $this->screenName;
        }
        return $this->realName;
    }

    public function setScreenName(string $screenName)
    {
        $this->screenName = $screenName;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function deleteScreenName()
    {
        $this->screenName = null;
    }


}