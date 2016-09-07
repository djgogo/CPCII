<?php

class PasswordLostProcessor implements ProcessorInterface {

    /**
     * @var Session
     */
    private $session;

    /**
     * @var UserTableDataGateway
     */
    private $gateway;

    /**
     * @var Mailer
     */
    private $mailer;

    /**
     * @param UserTableDataGateway $gateway
     * @param Session              $session
     */
    public function __construct(Session $session, UserTableDataGateway $gateway, Mailer $mailer) {
        $this->session = $session;
        $this->gateway = $gateway;
        $this->mailer = $mailer;
    }

    public function execute(HttpRequest $request) {
        $userData = $this->gateway->findUserByUserName($request->getParameter('username'));
        $linkToken = sha1(file_get_contents('/dev/urandom', NULL, NULL, NULL, 1024));
        $this->gateway->updateResetToken($userData['id'], $linkToken);
        $this->mailer->sendPasswordResetMail($userData['email'], $linkToken);
        $this->session->setKey('UserId', $userData['id']);
        return new Url('/password/lost/step2');
    }

}
