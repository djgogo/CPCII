<?php

namespace Suxx\Routers
{
    use Suxx\Factories\Factory;
    use Suxx\Http\Request;
    use Suxx\Http\Session;
    use Suxx\Loggers\ErrorLogger;

    class PostRequestRouter
    {
        /**
         * @var Factory
         */
        private $factory;

        /**
         * @var Session
         */
        private $session;

        /**
         * @var ErrorLogger
         */
        private $logger;

        public function __construct(Factory $factory, Session $session, ErrorLogger $logger)
        {
            $this->factory = $factory;
            $this->session = $session;
            $this->logger = $logger;
        }

        public function route(Request $request)
        {
            if (!$request->isPostRequest()) {
                return null;
            }

            $uri = $request->getRequestUri();
            $path = parse_url($uri)['path'];

            if ($this->hasCsrfError($request)) {
                return $this->factory->getError500Controller();
            }

            switch ($path) {
                case '/suxx/comment':
                    return $this->factory->getCommentController();
                case '/suxx/updateproduct';
                    return $this->factory->getUpdateProductController();
                default:
                    return null;
            }
        }

        protected function hasCsrfError(Request $request)
        {
            if ($request->getValue('csrf') != $this->session->getValue('token')) {
                $message = 'Das übergebene Formular hat kein gültiges CSRF-Token!';
                $this->logger->logMessage($message, debug_backtrace());
                return true;
            }
            return false;
        }
    }
}
