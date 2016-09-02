<?php
class SecurityTokensTableDataGateway
{
    /**
     * @var PDO
     */
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function setRememberMeTokens($userId, $identifier, $securityToken)
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO securitytokens (
                userid, 
                identifier, 
                securitytoken
                ) 
            VALUES (
            :userid, 
            :identifier, 
            :securitytoken
            )"
        );

        $stmt->bindParam('userid', $userId, PDO::PARAM_INT);
        $stmt->bindParam('identifier', $identifier, PDO::PARAM_STR);
        $stmt->bindParam('securitytoken', sha1($securityToken), PDO::PARAM_STR);

        $stmt->execute();
    }

    public function setCookie($identifier, $securityToken)
    {
        setcookie("identifier", $identifier, time() + (3600 * 24 * 365)); //1 Jahr Gültigkeit
        setcookie("securitytoken", $securityToken, time() + (3600 * 24 * 365)); //1 Jahr Gültigkeit
    }

}
