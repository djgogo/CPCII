<?php

class SuxxRegisterController implements SuxxController
{
    /**
     * @var SuxxRegistrationFormCommand
     */
    private $registrationFormCommand;

    /**
     * @var SuxxProductTableDataGateway
     */
    private $dataGateway;

    public function __construct(
        SuxxRegistrationFormCommand $registrationFormCommand,
        SuxxProductTableDataGateway $dataGateway)
    {
        $this->registrationFormCommand = $registrationFormCommand;
        $this->dataGateway = $dataGateway;
    }

    public function execute(SuxxRequest $request, SuxxResponse $response)
    {
        $result = $this->registrationFormCommand->execute($request);

        if ($result === false) {
            return 'register.twig';
        }

        $response->setProducts($this->dataGateway->getAllProducts());
        return 'base.twig';
    }
}
