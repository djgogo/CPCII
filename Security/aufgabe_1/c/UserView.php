<?php
declare(strict_types = 1);

class UserView
{
    /**
     * @var User
     */
    private $user;

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
    private $screenName;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->escapeView();
    }

    public function getRealName() : string
    {
        return $this->realName;
    }

    public function getEmail() : string
    {
        return $this->email;
    }

    public function getScreenName() :string
    {
        return $this->screenName;
    }

    private function escapeView()
    {
        $this->realName = $this->escape($this->user->getRealName());
        $this->email = $this->escape($this->user->getEmail());
        $this->screenName = $this->escape($this->user->getScreenName());
    }

    private function escape($string) : string
    {
        return htmlspecialchars($string, ENT_QUOTES);
    }
}

