<?php

namespace Address\Controllers
{
    use Address\Http\Request;
    use Address\Http\Response;
    use Address\Http\Session;

    class HomeController implements Controller
    {
        /**
         * @var Session
         */
        private $session;

        public function __construct(Session $session)
        {
            $this->session = $session;
        }

        public function execute(Request $request, Response $response)
        {
            return 'home.twig';
        }
    }
}
