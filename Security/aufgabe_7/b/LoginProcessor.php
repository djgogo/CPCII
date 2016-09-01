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
     * @var UserTableDataGateway
     */
    private $gateway;

    /**
     * @param Authenticator        $authenticator
     * @param UserTableDataGateway $gateway
     * @param Session              $session
     */
    public function __construct(Authenticator $authenticator, UserTableDataGateway $gateway, Session $session)
    {
        $this->authenticator = $authenticator;
        $this->gateway = $gateway;
        $this->session = $session;
    }

    public function execute(HttpRequest $request)
    {
        $username = $request->getParameter('USERNAME');
        $password = $request->getParameter('PASSWORD');

        $userId = $this->authenticator->authenticate($username, $password);

        if ($userId !== false) {
            $this->session->setKey('userId', $userId);
            return new Url('/secure');
        }
        return new Url('/login/failed');
    }

}
