<?php
declare(strict_types=1);

class Session
{
    private $user;

    public function hasUser() : bool
    {
        return true;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }

    public function getUser() : User
    {
        return $this->user;
    }
}
