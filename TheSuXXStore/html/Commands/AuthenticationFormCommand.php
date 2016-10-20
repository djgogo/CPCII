<?php

class SuxxAuthenticationFormCommand
{
    /**
     * @var SuxxRequest
     */
    private $request;

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

    public function __construct(SuxxAuthenticator $authenticator, SuxxRequest $request)
    {
        $this->request = $request;
        $this->authenticator = $authenticator;

        $this->username = $request->getValue('username');
        $this->passwd = $request->getValue('passwd');
    }

    public function validateRequest()
    {
        if ($this->username === '') {
            $this->request->setParams(['message' => 'Bitte geben Sie einen Usernamen ein']);
        }

        if ($this->passwd === '') {
            $this->request->setParams(['message' => 'Bitte geben Sie ein Passwort ein']);
        }
    }

    public function performAction()
    {
        if ($this->authenticator->authenticate($this->username, $this->passwd)) {
            $_SESSION['message'] = 'Willkommen - Du bist eingeloggt!';
            return true;
        } else {
            $_SESSION['message'] = 'Log-In fehlgeschlagen!';
            return false;
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

