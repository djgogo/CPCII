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

    public function execute(SuxxRequest $request, SuxxResponse $response)
    {
        $registrationFormCommand = new SuxxRegistrationFormCommand($this->registrator, $request);
        $registrationFormCommand->validateRequest();

        if ($registrationFormCommand->hasErrors()) {
            // TODO $registrationFormCommand->repopulateform();
        } else {
            $registrationFormCommand->performAction();
        }

        $response->products = $this->dataGateway->getAllProducts();
        return new SuxxStaticView(__DIR__ . '/../Pages/homepage.xhtml');
    }
}
