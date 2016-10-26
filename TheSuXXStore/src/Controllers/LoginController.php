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

        $authenticationFormCommand = new SuxxAuthenticationFormCommand($this->authenticator, $request, $session);
        $authenticationFormCommand->validateRequest();

        if ($authenticationFormCommand->hasErrors()) {
            // TODO $registrationFormCommand->repopulateform();
        } else {
            $check = $authenticationFormCommand->performAction();
        }

        if (!$check) {
            $response->products = $this->dataGateway->getAllProducts();
            return new SuxxStaticView(__DIR__ . '/../../Pages/homepage.xhtml');
        }

        session_regenerate_id();
        $_SESSION = $session->getSessionData();
        $response->setRedirect('/');
    }

}
