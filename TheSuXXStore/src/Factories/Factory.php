<?php

class SuxxFactory
{
    /**
     * @var PDOFactory
     */
    private $pdoFactory;

    /**
     * @var string
     */
    protected $defaultController = 'SuxxErrorController';

    /**
     * @var SuxxSession
     */
    private $session;

    public function __construct(PDOFactory $pdoFactory, SuxxSession $session)
    {
        $this->pdoFactory = $pdoFactory;
        $this->session = $session;
    }

    public function setDefaultController($default)
    {
        $this->defaultController = $default;
    }

    public function getDatabase() : PDO
    {
        return $this->pdoFactory->getDbHandler();
    }

    public function getRouter()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            return new SuxxStaticPageRouter($this);
        } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
            return new SuxxPostRequestRouter($this, $this->session);
        }
    }

    public function getHomeController() : SuxxHomeController
    {
        return new SuxxHomeController($this->getProductTableGateway());
    }

    public function getRegisterViewController() : SuxxRegisterViewController
    {
        return new SuxxRegisterViewController();
    }

    public function getRegisterController() : SuxxRegisterController
    {
        $registrator = new SuxxRegistrator($this->getUserTableGateway());
        return new SuxxRegisterController($this->getProductTableGateway(), $registrator);
    }

    public function getLoginViewController() : SuxxLoginViewController
    {
        return new SuxxLoginViewController();
    }

    public function getLoginController() : SuxxLoginController
    {
        $authenticator = new SuxxAuthenticator($this->getUserTableGateway());
        return new SuxxLoginController($this->getProductTableGateway(), $authenticator);
    }

    public function getLogoutController() : SuxxLogoutController
    {
        return new SuxxLogoutController();
    }

    public function getProductController() : SuxxProductController
    {
        return new SuxxProductController($this->getProductTableGateway(), $this->getCommentTableGateway());
    }

    public function getUpdateProductViewController() : SuxxUpdateProductViewController
    {
        return new SuxxUpdateProductViewController($this->getProductTableGateway());
    }

    public function getUpdateProductController() : SuxxUpdateProductController
    {
        return new SuxxUpdateProductController($this->getProductTableGateway());
    }

    public function getCommentController() : SuxxCommentController
    {
        return new SuxxCommentController($this->getCommentTableGateway(), new SuxxFileBackend());
    }

    public function getErrorController() : SuxxErrorController
    {
        return new SuxxErrorController();
    }

    public function get404Controller() : Suxx404Controller
    {
        return new Suxx404Controller();
    }

    protected function getProductTableGateway() : SuxxProductTableDataGateway
    {
        return new SuxxProductTableDataGateway($this->getDatabase());
    }

    protected function getCommentTableGateway() : SuxxCommentTableDataGateway
    {
        return new SuxxCommentTableDataGateway($this->getDatabase());
    }

    protected function getUserTableGateway() : SuxxUserTableDataGateway
    {
        return new SuxxUserTableDataGateway($this->getDatabase());
    }
}
