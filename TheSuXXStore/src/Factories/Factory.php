<?php

namespace Suxx\Factories
{
    use Suxx\Authentication\Authenticator;
    use Suxx\Authentication\Registrator;
    use Suxx\Backends\FileBackend;
    use Suxx\Commands\AuthenticationFormCommand;
    use Suxx\Commands\CommentFormCommand;
    use Suxx\Commands\RegistrationFormCommand;
    use Suxx\Commands\UpdateProductFormCommand;
    use Suxx\Controllers\CommentController;
    use Suxx\Controllers\Error404Controller;
    use Suxx\Controllers\Error500Controller;
    use Suxx\Controllers\HomeController;
    use Suxx\Controllers\LoginController;
    use Suxx\Controllers\LoginViewController;
    use Suxx\Controllers\LogoutController;
    use Suxx\Controllers\ProductController;
    use Suxx\Controllers\RegisterController;
    use Suxx\Controllers\RegisterViewController;
    use Suxx\Controllers\UpdateProductController;
    use Suxx\Controllers\UpdateProductViewController;
    use Suxx\Forms\FormError;
    use Suxx\Forms\FormPopulate;
    use Suxx\Gateways\CommentTableDataGateway;
    use Suxx\Gateways\ProductTableDataGateway;
    use Suxx\Gateways\UserTableDataGateway;
    use Suxx\Http\Session;
    use Suxx\Loggers\ErrorLogger;
    use Suxx\Routers\AuthenticationRouter;
    use Suxx\Routers\Error404Router;
    use Suxx\Routers\PostRequestRouter;
    use Suxx\Routers\StaticPageRouter;

    class Factory
    {
        /**
         * @var PDOFactory
         */
        private $pdoFactory;

        /**
         * @var Session
         */
        private $session;

        /**
         * @var string
         */
        private $errorLogPath;

        public function __construct(PDOFactory $pdoFactory, Session $session, string $errorLogPath)
        {
            $this->pdoFactory = $pdoFactory;
            $this->session = $session;
            $this->errorLogPath = $errorLogPath;
        }

        public function getDatabase() : \PDO
        {
            return $this->pdoFactory->getDbHandler();
        }

        /**
         * Routers
         */
        public function getRouters() : array
        {
            return [
                new StaticPageRouter($this),
                new PostRequestRouter($this, $this->session, $this->getErrorLogger()),
                new AuthenticationRouter($this, $this->session),
                new Error404Router($this),
            ];
        }

        /**
         * Controllers
         */
        public function getHomeController() : HomeController
        {
            return new HomeController($this->session, $this->getProductTableGateway());
        }

        public function getRegisterViewController() : RegisterViewController
        {
            return new RegisterViewController($this->session);
        }

        public function getRegisterController() : RegisterController
        {
            return new RegisterController($this->getRegistrationFormCommand(), $this->getProductTableGateway());
        }

        public function getLoginViewController() : LoginViewController
        {
            return new LoginViewController($this->session);
        }

        public function getLoginController() : LoginController
        {
            return new LoginController($this->getAuthenticationFormCommand());
        }

        public function getLogoutController() : LogoutController
        {
            return new LogoutController();
        }

        public function getProductController() : ProductController
        {
            return new ProductController($this->getProductTableGateway(), $this->getCommentTableGateway());
        }

        public function getUpdateProductViewController() : UpdateProductViewController
        {
            return new UpdateProductViewController($this->session, $this->getProductTableGateway(), $this->getFormPopulate());
        }

        public function getUpdateProductController() : UpdateProductController
        {
            return new UpdateProductController($this->getUpdateProductFormCommand(), $this->getProductTableGateway());
        }

        public function getCommentController() : CommentController
        {
            return new CommentController($this->getCommentFormCommand());
        }

        public function getError404Controller() : Error404Controller
        {
            return new Error404Controller();
        }

        public function getError500Controller() : Error500Controller
        {
            return new Error500Controller();
        }

        /**
         * TableDataGateways
         */
        public function getProductTableGateway() : ProductTableDataGateway
        {
            return new ProductTableDataGateway($this->getDatabase(), $this->getErrorLogger());
        }

        public function getCommentTableGateway() : CommentTableDataGateway
        {
            return new CommentTableDataGateway($this->getDatabase(), $this->getErrorLogger());
        }

        public function getUserTableGateway() : UserTableDataGateway
        {
            return new UserTableDataGateway($this->getDatabase(), $this->getErrorLogger());
        }

        /**
         * FormCommands
         */
        public function getCommentFormCommand() : CommentFormCommand
        {
            return new CommentFormCommand($this->getCommentTableGateway(), $this->session, $this->getFileBackend(), $this->getFormError());
        }

        public function getAuthenticationFormCommand() : AuthenticationFormCommand
        {
            $authenticator = new Authenticator($this->getUserTableGateway());
            return new AuthenticationFormCommand($authenticator, $this->session, $this->getFormPopulate(), $this->getFormError());
        }

        public function getRegistrationFormCommand() : RegistrationFormCommand
        {
            $registrator = new Registrator($this->getUserTableGateway());
            return new RegistrationFormCommand($registrator, $this->session, $this->getFormPopulate(), $this->getFormError());
        }

        public function getUpdateProductFormCommand() : UpdateProductFormCommand
        {
            return new UpdateProductFormCommand($this->getProductTableGateway(), $this->session, $this->getFormPopulate(), $this->getFormError());
        }

        /**
         * Forms Error Handling and Re-Population
         */
        public function getFormError() : FormError
        {
            return new FormError($this->session);
        }

        public function getFormPopulate() : FormPopulate
        {
            return new FormPopulate($this->session);
        }

        /**
         * File Backend's
         */
        public function getFileBackend() : FileBackend
        {
            return new FileBackend();
        }

        /**
         * Logger's
         */
        public function getErrorLogger() : ErrorLogger
        {
            $datetime = new \DateTime();
            $datetime->setTimezone(new \DateTimeZone('Europe/Zurich'));

            return new ErrorLogger($datetime, $this->errorLogPath);
        }
    }
}
