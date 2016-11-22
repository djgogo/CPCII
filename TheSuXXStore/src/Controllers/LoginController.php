<?php

namespace Suxx\Controllers
{
    use Suxx\Commands\AuthenticationFormCommand;
    use Suxx\Http\Request;
    use Suxx\Http\Response;
    use Suxx\Http\Session;

    class LoginController implements Controller
    {
        /**
         * @var Session
         */
        private $session;

        /**
         * @var AuthenticationFormCommand
         */
        private $authenticationFormCommand;


        public function __construct(
            Session $session,
            AuthenticationFormCommand $authenticationFormCommand)
        {
            $this->session = $session;
            $this->authenticationFormCommand = $authenticationFormCommand;
        }

        public function execute(Request $request, Response $response)
        {
            $result = $this->authenticationFormCommand->execute($request);

            if ($result === false) {
                return 'login.twig';
            }

            session_regenerate_id();
            $_SESSION = $this->session->getSessionData();
            $response->setRedirect('/');
        }

    }
}
