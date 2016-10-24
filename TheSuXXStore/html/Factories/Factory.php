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

    public function __construct(PDOFactory $pdoFactory)
    {
        $this->pdoFactory = $pdoFactory;
    }

    public function setDefaultController($default)
    {
        $this->defaultController = $default;
    }

    public function getDatabase() : PDO
    {
        return $this->pdoFactory->getDbHandler();
    }

    public function getRouter() : SuxxRouter
    {
        return new SuxxRouter($this);
    }

    public function getHomeController() : SuxxHomeController
    {
        return new SuxxHomeController($this->getProductTableGateway());
    }

    public function getRegisterController() : SuxxRegisterController
    {
        $registrator = new SuxxRegistrator($this->getUserTableGateway());
        return new SuxxRegisterController($this->getProductTableGateway(), $registrator);
    }

    public function getLoginController() : SuxxLoginController
    {
        $authenticator = new SuxxAuthenticator($this->getUserTableGateway());
        return new SuxxLoginController($this->getProductTableGateway(), $authenticator);
    }

    public function getLogoutController() : SuxxLogoutController
    {
        return new SuxxLogoutController($this->getProductTableGateway());
    }

    public function getProductController() : SuxxProductController
    {
        return new SuxxProductController($this->getProductTableGateway(), $this->getCommentTableGateway());
    }

    public function getCommentController() : SuxxCommentController
    {
        return new SuxxCommentController($this->getCommentTableGateway());
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
