<?php
declare(strict_types=1);

class User
{
    private $nickname;
    private $email;

    public function __construct(Nickname $nickname, Email $email)
    {
        $this->nickname = $nickname;
        $this->email    = $email;
    }

    public function getNickname() : Nickname
    {
        return $this->nickname;
    }

    public function getEmail() : Email
    {
        return $this->email;
    }
}
