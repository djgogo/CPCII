<?php

namespace Address\Controllers {

    use Address\Http\Request;
    use Address\Http\Response;
    use Address\Http\Session;

    class RegisterViewController implements ControllerInterface
    {
        /** @var Session */
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

            return 'authentication/register.twig';
        }
    }
}
