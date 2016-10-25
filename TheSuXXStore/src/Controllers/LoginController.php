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
        //unset($session->session['error']);
        $session->setValue('error', '');
        $check = false;

        $authenticationFormCommand = new SuxxAuthenticationFormCommand($this->authenticator, $request, $session);
        $authenticationFormCommand->validateRequest();

        if ($authenticationFormCommand->hasErrors()) {
            // TODO $registrationFormCommand->repopulateform();
        } else {
            $check = $authenticationFormCommand->performAction();
        }

        if (!$check) {
//            $response->products = $this->dataGateway->getAllProducts();
//            return new SuxxStaticView(__DIR__ . '/../../Pages/homepage.xhtml');
            return new SuxxStaticView(__DIR__ . '/../../Pages/loginfailed.xhtml');
        }

        session_regenerate_id();
        $response->products = $this->dataGateway->getAllProducts();
        return new SuxxStaticView(__DIR__ . '/../../Pages/homepage.xhtml');
//        header('Location: /', 302);
    }

}
