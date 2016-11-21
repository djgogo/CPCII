<?php

use Suxx\SuxxUserTableDataGateway;

class SuxxRegistrator
{
    /**
     * @var UserTableDataGateway
     */
    private $userGateway;

    public function __construct(SuxxUserTableDataGateway $userGateway)
    {
        $this->userGateway = $userGateway;
    }

    public function register($row) : bool
    {
        return $this->userGateway->insert($row);
    }

    public function usernameExists(string $username)
    {
        return $this->userGateway->findUserByUsername($username);
    }
}

