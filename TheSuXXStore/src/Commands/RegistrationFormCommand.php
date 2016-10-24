<?php

class SuxxRegistrationFormCommand
{
    /**
     * @var SuxxRequest
     */
    private $request;

    /**
     * @var SuxxSession
     */
    private $session;

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

    public function __construct(SuxxRegistrator $registrator, SuxxRequest $request, SuxxSession $session)
    {
        $this->request = $request;
        $this->session = $session;
        $this->registrator = $registrator;

        $this->username = $request->getValue('username');
        $this->passwd = $request->getValue('passwd');
        $this->name = $request->getValue('name');
        $this->email = $request->getValue('email');
    }

    public function validateRequest()
    {
        if ($this->username === '') {
            $this->session->setValue('error', 'Bitte geben Sie einen Usernamen ein');
        }

        if ($this->passwd === '') {
            $this->session->setValue('error', 'Bitte geben Sie ein Passwort ein');
        }

        if (strlen($this->passwd) < 6) {
            $this->session->setValue('error', 'Das Passwort muss mindestens 6 Zeichen lang sein');
        }

        if ($this->name === '') {
            $this->session->setValue('error', 'Bitte geben Sie einen Namen ein');
        }

        try {
            new Email($this->email);
        } catch (\InvalidArgumentException $e) {
            $this->session->setValue('error', 'Bitte geben Sie eine gültige Email-Adresse ein');
        }

        if ($this->username !== '' && $this->registrator->usernameExists($this->username)) {
            $this->session->setValue('error', 'Username bereits vergeben!');
        }
    }

    public function performAction()
    {
        $row = [
            'username' => $this->username,
            'password' => $this->passwd,
            'email' => $this->email,
            'name' => $this->name,
            'description' => 'Suxx Account'
        ];

        if ($this->registrator->register($row)) {
            $this->session->setValue('message', 'Vielen Dank für die Anmeldung - Loggen Sie sich bitte ein');
        } else {
            $this->session->setValue('message', 'Anmeldung fehlgeschlagen!');
        }
    }

    public function hasErrors() : bool
    {
        if ($this->session->isset('error')) {
            return true;
        }
        return false;
    }
}

