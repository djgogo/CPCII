<?php

namespace Suxx\Controllers
{
    use Suxx\Commands\AuthenticationFormCommand;
    use Suxx\Http\Request;
    use Suxx\Http\Response;

    class LoginController implements Controller
    {
        /**
         * @var AuthenticationFormCommand
         */
        private $authenticationFormCommand;


        public function __construct(AuthenticationFormCommand $authenticationFormCommand)
        {
            $this->authenticationFormCommand = $authenticationFormCommand;
        }

        public function execute(Request $request, Response $response)
        {
            $result = $this->authenticationFormCommand->execute($request);

            if ($result === false) {
                return 'login.twig';
            }

            session_regenerate_id();
            $response->setRedirect('/');
        }

    }
}
