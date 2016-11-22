<?php

namespace Suxx\Controllers {

    use Suxx\Http\Request;
    use Suxx\Http\Response;
    use Suxx\Http\Session;

    class RegisterViewController implements Controller
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
            if ($this->session->isset('error')) {
                $this->session->deleteValue('error');
            }

            return 'register.twig';
        }
    }
}
