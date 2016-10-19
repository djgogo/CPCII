<?php

class SuxxRegistrationFormCommand
{
    /**
     * @var SuxxRequest
     */
    private $request;

    /**
     * @var SuxxRegistrator
     */
    private $registrator;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $passwd;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $email;

    public function __construct(SuxxRegistrator $registrator, SuxxRequest $request)
    {
        $this->request = $request;
        $this->registrator = $registrator;

        $this->username = $request->getValue('username');
        $this->passwd = $request->getValue('passwd');
        $this->name = $request->getValue('name');
        $this->email = $request->getValue('email');
    }

    public function validateRequest()
    {
        if ($this->username === '') {
            $this->request->setParams(['message' => 'Bitte geben Sie einen Usernamen ein']);
        }

        if ($this->passwd === '') {
            $this->request->setParams(['message' => 'Bitte geben Sie ein Passwort ein']);
        }

        if ($this->name === '') {
            $this->request->setParams(['message' => 'Bitte geben Sie einen Namen ein']);
        }

        try {
            new Email($this->email);
        } catch (\InvalidArgumentException $e) {
            $this->request->setParams(['message' => 'Bitte geben Sie eine gültige Email-Adresse ein']);
        }
    }

    public function performAction()
    {
        $row = [
            'username' => $this->username,
            'password' => $this->passwd,
            'email' => $this->email,
            'name' => $this->name,
            'description' => 'Test Account'
        ];

        if ($this->registrator->register($row)) {
            $this->request->setParams(['message' => 'Vielen Dank für die Anmeldung']);
        } else {
            $this->request->setParams(['message' => 'Anmeldung fehlgeschlagen!']);
        }
    }

    public function hasErrors() : bool
    {
        if ($this->request->params !== null) {
            return true;
        }
        return false;
    }
}

