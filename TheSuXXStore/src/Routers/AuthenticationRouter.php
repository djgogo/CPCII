<?php

namespace Suxx\Routers
{
    use Suxx\Factories\Factory;
    use Suxx\Http\Session;
    use Suxx\Http\Request;

    class AuthenticationRouter
    {
        /**
         * @var Factory
         */
        private $factory;

        /**
         * @var Session
         */
        private $session;

        public function __construct(Factory $factory, Session $session)
        {
            $this->factory = $factory;
            $this->session = $session;
        }

        public function route(Request $request)
        {
            if (!$request->isPostRequest()) {
                return null;
            }

            $uri = $request->getRequestUri();
            $path = parse_url($uri)['path'];

            if ($this->hasCsrfError($request->getValue('csrf'))) {
                return $this->factory->getHomeController();
            }

            switch ($path) {
                case '/suxx/login':
                    return $this->factory->getLoginController();
                case '/suxx/register':
                    return $this->factory->getRegisterController();
                default:
                    return null;
            }
        }

        protected function hasCsrfError(string $csrfToken)
        {
            if ($csrfToken != $this->session->getValue('token')) {
                $this->session->setValue('error', 'Das übergebene Formular hat kein gültiges CSRF-Token!');
                return true;
            }
            return false;
        }
    }
}
