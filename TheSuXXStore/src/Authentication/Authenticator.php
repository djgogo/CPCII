<?php

namespace Suxx\Authentication {

    use Suxx\Gateways\UserTableDataGateway;

    class Authenticator
    {
        /**
         * @var UserTableDataGateway
         */
        private $userGateway;

        public function __construct(UserTableDataGateway $userGateway)
        {
            $this->userGateway = $userGateway;
        }

        public function authenticate(string $username, string $password) : bool
        {
            return $this->userGateway->findUserByCredentials($username, $password);
        }
    }
}

