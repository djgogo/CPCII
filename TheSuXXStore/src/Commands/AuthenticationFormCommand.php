<?php

class SuxxAuthenticationFormCommand extends SuxxAbstractFormCommand
{
    /**
     * @var SuxxSession
     */
    private $session;

    /**
     * @var SuxxAuthenticator
     */
    private $authenticator;

    /**
     * @var SuxxFormPopulate
     */
    private $populate;

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
    private $password;

    public function __construct(SuxxAuthenticator $authenticator, SuxxSession $session, SuxxFormPopulate $formPopulate, SuxxFormError $error)
    {
        $this->session = $session;
        $this->authenticator = $authenticator;
        $this->populate = $formPopulate;
        $this->error = $error;
    }

    public function execute(SuxxRequest $request)
    {
        if ($this->session->isset('error')) {
            $this->session->deleteValue('error');
        }

        $this->username = $request->getValue('username');
        $this->password = $request->getValue('password');

        $this->validateRequest();
        if (!$this->hasErrors()) {
            $this->performAction();
            return true;
        }
        $this->repopulateForm();
        return false;
    }

    protected function validateRequest()
    {
        if ($this->username === '') {
            $this->error->set('username', 'Bitte geben Sie einen Usernamen ein');
        }

        if ($this->password === '') {
            $this->error->set('password', 'Bitte geben Sie ein Passwort ein');
        }
    }

    protected function performAction(): bool
    {
        if ($this->authenticator->authenticate($this->username, $this->password)) {
            $this->session->setValue('message', 'Willkommen - Du bist eingeloggt!');
            $this->session->setValue('user', $this->username);
            return true;
        } else {
            $this->session->setValue('warning', 'Log-In fehlgeschlagen!');
            return false;
        }
    }

    protected function hasErrors() : bool
    {
        if ($this->session->isset('error')) {
            return true;
        }
        return false;
    }

    public function repopulateForm()
    {
        if ($this->username !== '') {
            $this->populate->set('username', $this->username);
        }

        if ($this->password !== '') {
            $this->populate->set('password', $this->password);
        }
    }
}

