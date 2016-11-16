<?php

namespace Suxx
{
    class SuxxLoginController implements \SuxxController
    {
        /**
         * @var \SuxxSession
         */
        private $session;

        /**
         * @var \SuxxAuthenticationFormCommand
         */
        private $authenticationFormCommand;


        public function __construct(
            \SuxxSession $session,
            \SuxxAuthenticationFormCommand $authenticationFormCommand)
        {
            $this->session = $session;
            $this->authenticationFormCommand = $authenticationFormCommand;
        }

        public function execute(\SuxxRequest $request, \SuxxResponse $response)
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
