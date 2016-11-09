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
    private $passwd;

    public function __construct(SuxxAuthenticator $authenticator, SuxxSession $session, SuxxFormPopulate $formPopulate, SuxxFormError $error)
    {
        $this->session = $session;
        $this->authenticator = $authenticator;
        $this->populate = $formPopulate;
        $this->error = $error;
    }

    public function execute(SuxxRequest $request)
    {
        $this->session->deleteValue('error');

        $this->username = $request->getValue('username');
        $this->passwd = $request->getValue('passwd');

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

        if ($this->passwd === '') {
            $this->error->set('password', 'Bitte geben Sie ein Passwort ein');
        }
    }

    protected function performAction(): bool
    {
        if ($this->authenticator->authenticate($this->username, $this->passwd)) {
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

    protected function repopulateForm()
    {
        if ($this->username !== '') {
            $this->populate->set('username', $this->username);
        }

        if ($this->passwd !== '') {
            $this->populate->set('passwd', $this->passwd);
        }
    }
}

