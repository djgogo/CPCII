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

    /**
     * @return SecurePageProcessor
     */
    public function getSecurePageProcessor()
    {
        return new SecurePageProcessor();
    }

    /**
     * @return LoginProcessor
     */
    public function getLoginProcessor()
    {
        $authenticator = new Authenticator($this->getUserTableGateway());
        return new LoginProcessor($authenticator, $this->getUserTableGateway(), $this->getSession());
    }

    /**
     * @param $uri
     *
     * @return RedirectProcessor
     */
    public function getRedirectProcessor($uri)
    {
        return new RedirectProcessor($uri);
    }

    /**
     * @return PasswordChangeProcessor
     */
    public function getPasswordChangeProcessor()
    {
        return new PasswordChangeProcessor($this->getUserTableGateway());
    }

    public function getPasswordLostProcessor()
    {
        return new PasswordLostProcessor();
    }

    /**
     * @return Session
     */
    public function getSession()
    {
        if (!$this->session instanceof Session) {
            $this->session = new Session(new SessionStoreStub());
        }
        return $this->session;
    }

    /**
     * @return Router
     */
    public function getRouter()
    {
        return new Router($this);
    }

    /**
     * @return UserTableDataGateway
     */
    protected function getUserTableGateway()
    {
        return new UserTableDataGateway($this->pdo);
    }
}
