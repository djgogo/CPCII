<?php

class SuxxLoginController extends SuxxController
{
    /**
     * @var SuxxAuthenticator
     */
    private $authenticator;

    public function __construct(SuxxProductTableDataGateway $dataGateway, SuxxAuthenticator $authenticator)
    {
        $this->authenticator = $authenticator;
        parent::__construct($dataGateway);
    }

    public function execute(SuxxRequest $request, SuxxResponse $response)
    {
        $check = false;
        $authenticationFormCommand = new SuxxAuthenticationFormCommand($this->authenticator, $request);
        $authenticationFormCommand->validateRequest();

        if ($authenticationFormCommand->hasErrors()) {
            // TODO $registrationFormCommand->repopulateform();
        } else {
            $check = $authenticationFormCommand->performAction();
        }

        if (!$check) {
            return new SuxxStaticView(__DIR__ . '/../Pages/loginfailed.xhtml');
        }

        header('Location: /', 302);
    }

}
