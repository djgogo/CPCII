<?php

namespace Address\Factories
{
    use Address\Controllers\Error404Controller;
    use Address\Controllers\HomeController;
    use Address\Http\Session;
    use Address\Routers\Error404Router;
    use Address\Routers\GetRequestRouter;

    class Factory
    {
        /**
         * @var Session
         */
        private $session;

        public function __construct(Session $session)
        {
            $this->session = $session;
        }

        /**
         * Routers
         */
        public function getRouters() : array
        {
            return [
                new GetRequestRouter($this),
                new Error404Router($this),
            ];
        }

        /**
         * Controllers
         */
        public function getHomeController() : HomeController
        {
            return new HomeController($this->session);
        }

        public function getError404Controller() : Error404Controller
        {
            return new Error404Controller();
        }
    }
}
