<?php

class SecurePageProcessor implements ProcessorInterface
{
    /**
     * @var Authenticator
     */
    private $authenticator;

    /**
     * @var Session
     */
    private $session;

    public function __construct(Authenticator $authenticator, Session $session)
    {
        $this->session = $session;
        $this->authenticator = $authenticator;
    }

    public function execute(HttpRequest $request)
    {
        if (!$this->session->hasKey('userId') && isset($_COOKIE['identifier']) && isset($_COOKIE['securitytoken'])) {

            $identifier = $_COOKIE['identifier'];
            $securitytoken = $_COOKIE['securitytoken'];

            $result = $this->authenticator->handleRememberMeTokens($identifier, $securitytoken);


        }

        if (!$this->session->hasKey('userId')) {
            return new Url('/login');
        }

        return 'SecurePage';
    }

}
