<?php

namespace Address\Controllers
{
    use Address\Commands\AuthenticationFormCommand;
    use Address\Http\Request;
    use Address\Http\Response;

    class LoginController implements ControllerInterface
    {
        /** @var AuthenticationFormCommand */
        private $authenticationFormCommand;

        public function __construct(AuthenticationFormCommand $authenticationFormCommand)
        {
            $this->authenticationFormCommand = $authenticationFormCommand;
        }

        public function execute(Request $request, Response $response)
        {
            if (!$this->authenticationFormCommand->execute($request)) {
                return 'authentication/login.twig';
            }

            session_regenerate_id();
            $response->setRedirect('/');
        }
    }
}
