<?php

class SuxxRegistrationFormCommand extends SuxxAbstractFormCommand
{
    /**
     * @var SuxxSession
     */
    private $session;

    /**
     * @var SuxxRegistrator
     */
    private $registrator;

    /**
     * @var SuxxFormError
     */
    private $error;

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

    public function __construct(SuxxRegistrator $registrator, SuxxSession $session, SuxxFormError $error)
    {
        $this->session = $session;
        $this->registrator = $registrator;
        $this->error = $error;
    }

    public function execute(SuxxRequest $request)
    {
        $this->session->deleteValue('error');

        $this->username = $request->getValue('username');
        $this->passwd = $request->getValue('passwd');
        $this->name = $request->getValue('name');
        $this->email = $request->getValue('email');

        $this->validateRequest();
        if (!$this->hasErrors()) {
            $this->performAction();
            return true;
        }
        return false;
    }

    protected function validateRequest()
    {
        if ($this->username === '') {
            $this->error->set('username', 'Bitte geben Sie einen Usernamen ein');
            $this->session->setValue('error', $this->error);
        }

        if ($this->passwd === '') {
            $this->error->set('password', 'Bitte geben Sie ein Passwort ein');
            $this->session->setValue('error', $this->error);
        }

        if (strlen($this->passwd) < 6) {
            $this->error->set('password', 'Das Passwort muss mindestens 6 Zeichen lang sein');
            $this->session->setValue('error', $this->error);
        }

        if ($this->name === '') {
            $this->error->set('name', 'Bitte geben Sie einen Namen ein');
            $this->session->setValue('error', $this->error);
        }

        try {
            new Email($this->email);
        } catch (\InvalidArgumentException $e) {
            $this->error->set('email', 'Bitte geben Sie eine gültige Email-Adresse ein');
            $this->session->setValue('error', $this->error);
        }

        if ($this->username !== '' && $this->registrator->usernameExists($this->username)) {
            $this->error->set('username', 'Username bereits vergeben!');
            $this->session->setValue('error', $this->error);
        }
    }

    protected function performAction()
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

    protected function hasErrors() : bool
    {
        if ($this->session->isset('error')) {
            return true;
        }
        return false;
    }

    protected function repopulateForm()
    {
        if ($this->username !== '') {
            $this->session->setValue('register_username', $this->username);
        }

        if ($this->passwd !== '') {
            $this->session->setValue('register_passwd', $this->passwd);
        }

        if ($this->name !== '') {
            $this->session->setValue('register_name', $this->name);
        }

        if ($this->email !== '') {
            $this->session->setValue('register_email', $this->email);
        }
    }
}

