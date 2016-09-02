<?php
class Authenticator
{
    /**
     * @var UserTableDataGateway
     */
    private $userGateway;

    /**
     * @var SecurityTokensTableDataGateway
     */
    private $securityTokensGateway;

    /**
     * @param UserTableDataGateway $userGateway
     * @param SecurityTokensTableDataGateway $securityTokensGateway
     */
    public function __construct(UserTableDataGateway $userGateway, SecurityTokensTableDataGateway $securityTokensGateway)
    {
        $this->userGateway = $userGateway;
        $this->securityTokensGateway = $securityTokensGateway;
    }

    /**
     * @param string $username
     * @param string $password
     *
     * @return int
     */
    public function authenticate($username, $password)
    {
        return $this->userGateway->findIdByCredentials($username, $password);
    }

    public function rememberMe(int $userId)
    {
        $identifier = new Token();
        $securityToken = file_get_contents('/dev/urandom', NULL, NULL, NULL, 1024);

        $this->securityTokensGateway->setRememberMeTokens($userId, $identifier, $securityToken);
        $this->securityTokensGateway->setCookie($identifier, $securityToken);
    }

}
