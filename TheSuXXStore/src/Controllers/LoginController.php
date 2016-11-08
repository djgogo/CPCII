<?php

class SuxxLoginController implements SuxxController
{
    /**
     * @var SuxxSession
     */
    private $session;

    /**
     * @var SuxxAuthenticationFormCommand
     */
    private $authenticationFormCommand;

    /**
     * @var SuxxProductTableDataGateway
     */
    private $dataGateway;

    public function __construct(
        SuxxSession $session,
        SuxxAuthenticationFormCommand $authenticationFormCommand,
        SuxxProductTableDataGateway $dataGateway)
    {
        $this->session = $session;
        $this->authenticationFormCommand = $authenticationFormCommand;
        $this->dataGateway = $dataGateway;
    }

    public function execute(SuxxRequest $request, SuxxResponse $response)
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
