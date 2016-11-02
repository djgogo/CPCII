<?php

class SuxxLoginController implements SuxxController
{
    /**
     * @var SuxxAuthenticator
     */
    private $authenticator;

    /**
     * @var SuxxProductTableDataGateway
     */
    private $dataGateway;

    public function __construct(SuxxProductTableDataGateway $dataGateway, SuxxAuthenticator $authenticator)
    {
        $this->authenticator = $authenticator;
        $this->dataGateway = $dataGateway;
    }

    public function execute(SuxxRequest $request, SuxxSession $session, SuxxResponse $response)
    {
        $check = false;

        $loginFormError = [
            'username' => '',
            'password' => ''
        ];
        $authenticationFormCommand = new SuxxAuthenticationFormCommand($this->authenticator, $request, $session, $loginFormError);
        $authenticationFormCommand->validateRequest();

        if ($authenticationFormCommand->hasErrors()) {
            $authenticationFormCommand->repopulateForm();
        } else {
            $check = $authenticationFormCommand->performAction();
        }

        if (!$check) {
            return 'login.twig';
        }

        session_regenerate_id();
        $_SESSION = $session->getSessionData();
        $response->setRedirect('/');
    }

}
