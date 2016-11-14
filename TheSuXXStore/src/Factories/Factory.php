<?php

class SuxxFactory
{
    /**
     * @var PDOFactory
     */
    private $pdoFactory;

    /**
     * @var SuxxSession
     */
    private $session;

    public function __construct(PDOFactory $pdoFactory, SuxxSession $session)
    {
        $this->pdoFactory = $pdoFactory;
        $this->session = $session;
    }

    public function getDatabase() : PDO
    {
        return $this->pdoFactory->getDbHandler();
    }

    public function getRouters() : array
    {
        return [
            new SuxxStaticPageRouter($this),
            new SuxxPostRequestRouter($this, $this->session),
            new SuxxAuthenticationRouter($this, $this->session),
            new SuxxError404Router($this),
        ];
    }

    /**
     * Controllers
     */
    public function getHomeController() : SuxxHomeController
    {
        return new SuxxHomeController($this->session, $this->getProductTableGateway());
    }

    public function getRegisterViewController() : SuxxRegisterViewController
    {
        return new SuxxRegisterViewController($this->session);
    }

    public function getRegisterController() : SuxxRegisterController
    {
        return new SuxxRegisterController($this->getRegistrationFormCommand(), $this->getProductTableGateway());
    }

    public function getLoginViewController() : SuxxLoginViewController
    {
        return new SuxxLoginViewController($this->session);
    }

    public function getLoginController() : SuxxLoginController
    {
        return new SuxxLoginController($this->session, $this->getAuthenticationFormCommand(), $this->getProductTableGateway());
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
        return new SuxxUpdateProductViewController($this->session, $this->getProductTableGateway(), $this->getFormPopulate());
    }

    public function getUpdateProductController() : SuxxUpdateProductController
    {
        return new SuxxUpdateProductController($this->getUpdateProductFormCommand(), $this->getProductTableGateway());
    }

    public function getCommentController() : SuxxCommentController
    {
        return new SuxxCommentController($this->session, $this->getCommentFormCommand(), $this->getCommentTableGateway(), $this->getFileBackend());
    }

    public function getErrorController() : SuxxErrorController
    {
        return new SuxxErrorController();
    }

    public function get404Controller() : Suxx404Controller
    {
        return new Suxx404Controller();
    }

    /**
     * TableDataGateways
     */
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

    /**
     * FormCommands
     */
    public function getCommentFormCommand() : SuxxCommentFormCommand
    {
        return new SuxxCommentFormCommand($this->getCommentTableGateway(), $this->session, $this->getFileBackend(), $this->getFormError());
    }

    public function getAuthenticationFormCommand() : SuxxAuthenticationFormCommand
    {
        $authenticator = new SuxxAuthenticator($this->getUserTableGateway());
        return new SuxxAuthenticationFormCommand($authenticator, $this->session, $this->getFormPopulate(), $this->getFormError());
    }

    public function getRegistrationFormCommand() : SuxxRegistrationFormCommand
    {
        $registrator = new SuxxRegistrator($this->getUserTableGateway());
        return new SuxxRegistrationFormCommand($registrator, $this->session, $this->getFormPopulate(), $this->getFormError());
    }

    public function getUpdateProductFormCommand() : SuxxUpdateProductFormCommand
    {
        return new SuxxUpdateProductFormCommand($this->getProductTableGateway(), $this->session, $this->getFormPopulate(), $this->getFormError());
    }

    /**
     * Forms Errorhandling and Repopulate
     */
    protected function getFormError() : SuxxFormError
    {
        return new SuxxFormError($this->session);
    }

    protected function getFormPopulate() : SuxxFormPopulate
    {
        return new SuxxFormPopulate($this->session);
    }

    /**
     * FileBackends
     */
    protected function getFileBackend() : SuxxFileBackend
    {
        return new SuxxFileBackend();
    }
}
