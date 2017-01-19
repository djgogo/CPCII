<?php

namespace Address\Factories
{

    use Address\Controllers\AboutController;
    use Address\Controllers\Error404Controller;
    use Address\Controllers\HomeController;
    use Address\Gateways\AddressTableDataGateway;
    use Address\Http\Session;
    use Address\Loggers\ErrorLogger;
    use Address\Routers\Error404Router;
    use Address\Routers\GetRequestRouter;

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

        public function getAboutController(): AboutController
        {
            return new AboutController();
        }

        public function getError404Controller(): Error404Controller
        {
            return new Error404Controller();
        }

        /**
         * TableDataGateways
         */
        public function getAddressTableGateway(): AddressTableDataGateway
        {
            return new AddressTableDataGateway($this->getDatabase(), $this->getErrorLogger());
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
