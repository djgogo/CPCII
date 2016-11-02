<?php

class SuxxAuthenticationFormCommand
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
     * @var SuxxAuthenticator
     */
    private $authenticator;

    /**
     * @var array
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

    public function __construct(SuxxAuthenticator $authenticator, SuxxRequest $request, SuxxSession $session, array $error)
    {
        $this->request = $request;
        $this->session = $session;
        $this->authenticator = $authenticator;
        $this->error = $error;

        $this->username = $request->getValue('username');
        $this->passwd = $request->getValue('passwd');
    }

    public function validateRequest()
    {
        if ($this->username === '') {
            $this->error['username'] = 'Bitte geben Sie einen Usernamen ein';
            $this->session->setValue('error', $this->error);
        }

        if ($this->passwd === '') {
            $this->error['password'] = 'Bitte geben Sie ein Passwort ein';
            $this->session->setValue('error', $this->error);
        }
    }

    public function performAction(): bool
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

    public function hasErrors() : bool
    {
        if ($this->session->isset('error')) {
            return true;
        }
        return false;
    }

    public function repopulateForm()
    {
        if ($this->username !== '') {
            $this->session->setValue('login_username', $this->username);
        }

        if ($this->passwd !== '') {
            $this->session->setValue('login_passwd', $this->passwd);
        }
    }
}

