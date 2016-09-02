<?php

class Factory
{

    /**
     * @var PDO
     */
    private $pdo;

    /**
     * @var Session
     */
    private $session;

    /**
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getSecurePageProcessor() : SecurePageProcessor
    {
        return new SecurePageProcessor();
    }

    public function getLoginProcessor() : LoginProcessor
    {
        $authenticator = new Authenticator($this->getUserTableGateway(), $this->getSecurityTokensTableDataGateway());
        return new LoginProcessor($authenticator, $this->getSession());
    }

    public function getRedirectProcessor($uri) : RedirectProcessor
    {
        return new RedirectProcessor($uri);
    }

    public function getPasswordChangeProcessor() : PasswordChangeProcessor
    {
        return new PasswordChangeProcessor($this->getUserTableGateway());
    }

    public function getPasswordLostProcessor() : PasswordLostProcessor
    {
        return new PasswordLostProcessor();
    }

    public function getSession() : Session
    {
        if (!$this->session instanceof Session) {
            $this->session = new Session(new SessionStoreStub());
        }
        return $this->session;
    }

    public function getRouter() : Router
    {
        return new Router($this);
    }

    protected function getUserTableGateway() : UserTableDataGateway
    {
        return new UserTableDataGateway($this->pdo);
    }

    protected function getSecurityTokensTableDataGateway() : SecurityTokensTableDataGateway
    {
        return new SecurityTokensTableDataGateway($this->pdo);
    }
}
