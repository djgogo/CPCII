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
        $userId = $request->getParameter('ID');
        $rememberMe = $request->getParameter('REMEMBERME');

        if ($rememberMe === 'true' && !$this->session->hasKey('userId') && $request->hasCookie('rememberme') && $request->hasCookie('remembermetoken')) {

            $rememberMeToken = $request->getCookie('remembermetoken');
            $result = $this->authenticator->checkRememberMeToken($userId, $rememberMeToken);

            if ($result === false) {
                throw new RuntimeException("A presumably stolen Security Token has been identified!");
            }

            $this->session->setKey('userId', $userId);
            $this->session->commit();

        } else {
            return new Url('/login');
        }

        return 'SecurePage';
    }

}
