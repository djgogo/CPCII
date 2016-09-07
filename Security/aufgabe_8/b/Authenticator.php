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
     * @return int
     */
    public function authenticate(string $username, string $password)
    {
        return $this->userGateway->findIdByCredentials($username, $password);
    }

    public function rememberMe(int $userId)
    {
        $identifier = new Token();
        $securityToken = sha1(file_get_contents('/dev/urandom', NULL, NULL, NULL, 1024));

        $this->securityTokensGateway->setRememberMeTokens($userId, $identifier, $securityToken);
        $this->securityTokensGateway->setCookie($identifier, $securityToken);
        return $securityToken;
    }

    public function checkRememberMeTokens(string $identifier, string $securityToken) : bool
    {
        return $this->securityTokensGateway->checkSecurityToken($identifier, $securityToken);
    }

    public function findIdByIdentifier($identifier) : int
    {
        return $this->securityTokensGateway->getId($identifier);
    }

}
