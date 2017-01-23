<?php

namespace Address\Factories
{

    use Address\Commands\UpdateAddressFormCommand;
    use Address\Commands\UpdateTextFormCommand;
    use Address\Controllers\AboutController;
    use Address\Controllers\Error404Controller;
    use Address\Controllers\Error500Controller;
    use Address\Controllers\HomeController;
    use Address\Controllers\TextController;
    use Address\Controllers\UpdateAddressController;
    use Address\Controllers\UpdateAddressViewController;
    use Address\Controllers\UpdateTextController;
    use Address\Controllers\UpdateTextViewController;
    use Address\Forms\FormError;
    use Address\Forms\FormPopulate;
    use Address\Gateways\AddressTableDataGateway;
    use Address\Gateways\TextTableDataGateway;
    use Address\Http\Session;
    use Address\Loggers\ErrorLogger;
    use Address\Routers\Error404Router;
    use Address\Routers\GetRequestRouter;
    use Address\Routers\PostRequestRouter;

    class Factory
    {
        /** @var Session */
        private $session;

        /** @var PDOFactory */
        private $pdoFactory;

        /** @var string */
        private $errorLogPath;

        public function __construct(Session $session, PDOFactory $pdoFactory, string $errorLogPath)
        {
            $this->session = $session;
            $this->pdoFactory = $pdoFactory;
            $this->errorLogPath = $errorLogPath;
        }

        public function getDatabase(): \PDO
        {
            return $this->pdoFactory->getDbHandler();
        }

        /**
         * Routers
         */
        public function getRouters(): array
        {
            return [
                new GetRequestRouter($this),
                new PostRequestRouter($this, $this->session, $this->getErrorLogger()),
                new Error404Router($this),
            ];
        }

        /**
         * Controllers
         */
        public function getHomeController(): HomeController
        {
            return new HomeController($this->session, $this->getAddressTableGateway());
        }

        public function getTextController(): TextController
        {
            return new TextController($this->session, $this->getTextTableGateway());
        }

        public function getAboutController(): AboutController
        {
            return new AboutController();
        }

        public function getUpdateAddressViewController(): UpdateAddressViewController
        {
            return new UpdateAddressViewController($this->session, $this->getAddressTableGateway(), $this->getFormPopulate());
        }

        public function getUpdateAddressController(): UpdateAddressController
        {
            return new UpdateAddressController($this->getUpdateAddressFormCommand(), $this->getAddressTableGateway());
        }

        public function getUpdateTextViewController(): UpdateTextViewController
        {
            return new UpdateTextViewController($this->session, $this->getTextTableGateway(), $this->getFormPopulate());
        }

        public function getUpdateTextController(): UpdateTextController
        {
            return new UpdateTextController($this->getUpdateTextFormCommand(), $this->getTextTableGateway());
        }

        public function getError404Controller(): Error404Controller
        {
            return new Error404Controller();
        }

        public function getError500Controller(): Error500Controller
        {
            return new Error500Controller();
        }

        /**
         * TableDataGateways
         */
        public function getAddressTableGateway(): AddressTableDataGateway
        {
            return new AddressTableDataGateway($this->getDatabase(), $this->getErrorLogger());
        }

        public function getTextTableGateway(): TextTableDataGateway
        {
            return new TextTableDataGateway($this->getDatabase(), $this->getErrorLogger());
        }

        /**
         * FormCommands
         */
        public function getUpdateAddressFormCommand(): UpdateAddressFormCommand
        {
            return new UpdateAddressFormCommand($this->getAddressTableGateway(), $this->session, $this->getFormPopulate(), $this->getFormError());
        }

        public function getUpdateTextFormCommand(): UpdateTextFormCommand
        {
            return new UpdateTextFormCommand($this->getTextTableGateway(), $this->session, $this->getFormPopulate(), $this->getFormError());
        }

        /**
         * Forms Error Handling and Re-Population
         */
        public function getFormError(): FormError
        {
            return new FormError($this->session);
        }

        public function getFormPopulate(): FormPopulate
        {
            return new FormPopulate($this->session);
        }

        /**
         * Logger's
         */
        public function getErrorLogger(): ErrorLogger
        {
            $datetime = new \DateTime();
            $datetime->setTimezone(new \DateTimeZone('Europe/Zurich'));

            return new ErrorLogger($datetime, $this->errorLogPath);
        }
    }
}
