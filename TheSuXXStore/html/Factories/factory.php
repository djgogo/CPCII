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

    public function getController($name)
    {
        $name = 'Suxx' . ucfirst($name) . 'Controller';
        if (!class_exists($name)) {
            return new $this->defaultController($this);
        }
        return new $name($this);
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
        return new SuxxRegisterController($registrator);
    }

    protected function getProductTableGateway() : SuxxProductTableDataGateway
    {
        return new SuxxProductTableDataGateway($this->getDatabase());
    }

    protected function getUserTableGateway() : SuxxUserTableDataGateway
    {
        return new SuxxUserTableDataGateway($this->getDatabase());
    }
}