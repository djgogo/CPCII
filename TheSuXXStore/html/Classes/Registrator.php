<?php

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

    public function register(array $row)
    {
        return $this->userGateway->insert($row);
    }
}

