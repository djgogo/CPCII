<?php
class Authenticator {

    /**
     * @var UserTableDataGateway
     */
    private $gateway;

    /**
     * @param UserTableDataGateway $gateway
     */
    public function __construct(UserTableDataGateway $gateway) {
        $this->gateway = $gateway;
    }

    /**
     * @param string $username
     * @param string $password
     *
     * @return int
     */
    public function authenticate($username, $password) {
        return $this->gateway->findIdByCredentials($username, $password);
    }

}