<?php
class Authenticator
{
    /**
     * @var UserTableDataGateway
     */
    private $userGateway;

    /**
     * @param UserTableDataGateway $userGateway
     */
    public function __construct(UserTableDataGateway $userGateway)
    {
        $this->userGateway = $userGateway;
    }

    /**
     * @return int
     */
    public function authenticate(string $username, string $password)
    {
        return $this->userGateway->findIdByCredentials($username, $password);
    }

    public function rememberMe(int $userId)
    {
        $securityToken = new Token();
        $this->userGateway->setRememberMeToken($userId, $securityToken);
        return $securityToken;
    }

    public function checkRememberMeToken(int $userId, string $rememberMeToken) : bool
    {
        return $this->userGateway->checkRememberMeToken($userId, $rememberMeToken);
    }
}
