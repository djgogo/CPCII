<?php

class SuxxRegisterController implements SuxxController
{
    /**
     * @var SuxxRegistrator
     */
    private $registrator;

    /**
     * @var SuxxProductTableDataGateway
     */
    private $dataGateway;

    public function __construct(SuxxProductTableDataGateway $dataGateway, SuxxRegistrator $registrator)
    {
        $this->registrator = $registrator;
        $this->dataGateway = $dataGateway;
    }

    public function execute(SuxxRequest $request, SuxxSession $session, SuxxResponse $response)
    {
        $registrationFormCommand = new SuxxRegistrationFormCommand($this->registrator, $request, $session);
        $registrationFormCommand->validateRequest();

        if ($registrationFormCommand->hasErrors()) {
            // TODO $registrationFormCommand->repopulateform();
            return 'register.twig';
        } else {
            $registrationFormCommand->performAction();
        }

        $response->products = $this->dataGateway->getAllProducts();
        return 'base.twig';
    }
}
