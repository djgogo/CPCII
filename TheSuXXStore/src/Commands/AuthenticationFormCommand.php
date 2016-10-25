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
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $passwd;

    public function __construct(SuxxAuthenticator $authenticator, SuxxRequest $request, SuxxSession $session)
    {
        $this->request = $request;
        $this->session = $session;
        $this->authenticator = $authenticator;

        $this->username = $request->getValue('username');
        $this->passwd = $request->getValue('passwd');
    }

    public function validateRequest()
    {
        if ($this->username === '') {
            $this->session->setValue('error', 'Bitte geben Sie einen Usernamen ein');
        }

        if ($this->passwd === '') {
            $this->session->setValue('error', 'Bitte geben Sie ein Passwort ein');
        }
    }

    public function performAction()
    {
        if ($this->authenticator->authenticate($this->username, $this->passwd)) {
            $_SESSION['message'] = 'Willkommen - Du bist eingeloggt!';
            return true;
        } else {
            $this->session->setValue('error', 'Log-In fehlgeschlagen!');
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
}

