<?php

class SuxxRegisterController
{
    /**
     * @var SuxxRegistrator
     */
    private $registrator;

    public function __construct(SuxxRegistrator $registrator)
    {
        $this->registrator = $registrator;
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

        header('Location: /', 302); // TODO Redirect to Home with message for Login
        die();
    }
}
