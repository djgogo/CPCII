<?php
class SecurityTokensTableDataGateway
{
    /**
     * @var PDO
     */
    private $pdo;

    /**
     * @var Cookie
     */
    private $cookie;

    public function __construct(PDO $pdo, Cookie $cookie)
    {
        $this->pdo = $pdo;
        // Objekt Cookie ist im Echtfall nicht zu verwenden, funktioniert so nicht!
        // Sondern Set-Cookie im HTTP-Response - Cookie ist hier nur ein Stub
        $this->cookie = $cookie;
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
        $stmt->bindParam('securitytoken', $securityToken, PDO::PARAM_STR);

        $stmt->execute();
    }

    public function setCookie($identifier, $securityToken)
    {
        // 1 Jahr Gültigkeit - Implementierung im Echtfall
//        setcookie("identifier", $identifier, time() + (3600 * 24 * 365));
//        setcookie("securitytoken", $securityToken, time() + (3600 * 24 * 365));

        $this->cookie->set('identifier', $identifier);
        $this->cookie->set('securitytoken', $securityToken);
        //$this->cookie->set('SID', sid Token Object;
    }

    public function checkSecurityToken($identifier, $securityToken) : bool
    {
        $stmt = $this->pdo->prepare("SELECT * FROM securitytokens WHERE identifier = ?");
        $stmt->execute([$identifier]);
        $securityToken_row = $stmt->fetch();

        if (sha1($securityToken) !== $securityToken_row['securitytoken']) {
            return false;
        }

        $newSecurityToken = file_get_contents('/dev/urandom', NULL, NULL, NULL, 1024);
        $insert = $this->pdo->prepare("UPDATE securitytokens SET securitytoken = :securitytoken");
        $insert->execute(['securitytoken' => sha1($newSecurityToken)]);
        $this->setCookie($identifier, $newSecurityToken);

        return true;
    }

    public function getId($identifier) : int
    {
        $stmt = $this->pdo->prepare("SELECT * FROM securitytokens WHERE identifier = ?");
        $stmt->execute([$identifier]);
        $securityToken_row = $stmt->fetch();

        return $securityToken_row['userid'];
    }

}
