<?php
/**
 * Created by JetBrains PhpStorm.
 * User: theseer
 * Date: 2/26/13
 * Time: 12:08 AM
 * To change this template use File | Settings | File Templates.
 */
class LoginProcessor implements ProcessorInterface
{

    /**
     * @var Authenticator
     */
    private $authenticator;

    /**
     * @var Session
     */
    private $session;

    /**
     * @param Authenticator        $authenticator
     * @param Session              $session
     */
    public function __construct(Authenticator $authenticator, Session $session)
    {
        $this->authenticator = $authenticator;
        $this->session = $session;
    }

    public function execute(HttpRequest $request)
    {
        $username = $request->getParameter('USERNAME');
        $password = $request->getParameter('PASSWORD');
        $rememberMe = $request->getParameter('REMEMBERME');

        $userId = $this->authenticator->authenticate($username, $password);

        if ($userId !== false) {
            $this->session->setKey('userId', $userId);

            if ($rememberMe === true) {
                $this->authenticator->rememberMe($userId);
                $this->session->commit();
            }
            return new Url('/secure');
        }
        return new Url('/login/failed');
    }

}
