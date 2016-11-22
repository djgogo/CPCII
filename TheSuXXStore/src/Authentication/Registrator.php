<?php

namespace Suxx\Authentication {

    use Suxx\Gateways\UserTableDataGateway;

    class Registrator
    {
        /**
         * @var UserTableDataGateway
         */
        private $userGateway;

        public function __construct(UserTableDataGateway $userGateway)
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
}
