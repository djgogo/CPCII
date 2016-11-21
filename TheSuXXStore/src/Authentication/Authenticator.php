<?php

use Suxx\SuxxUserTableDataGateway;

class SuxxAuthenticator
{
    /**
     * @var UserTableDataGateway
     */
    private $userGateway;

    public function __construct(SuxxUserTableDataGateway $userGateway)
    {
        $this->userGateway = $userGateway;
    }

    public function authenticate(string $username, string $password) : bool
    {
        return $this->userGateway->findUserByCredentials($username, $password);
    }
}

