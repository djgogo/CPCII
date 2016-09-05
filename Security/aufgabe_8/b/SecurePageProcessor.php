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
        $rememberMe = $request->getParameter('REMEMBERME');

        if ($rememberMe === true && !$this->session->hasKey('userId') && $request->hasCookie('identifier') && $request->hasCookie('securitytoken')) {

            $identifier = $request->getCookie('identifier');
            $securityToken = $request->getCookie('securitytoken');
            $result = $this->authenticator->checkRememberMeTokens($identifier, $securityToken);

            if ($result === false) {
                throw new RuntimeException("A presumably stolen Security Token has been identified!");
            }

            $this->session->setKey('userId', $this->authenticator->findIdByIdentifier($identifier));
            $this->session->commit();

        } else {
            return new Url('/login');
        }

        return 'SecurePage';
    }

}
