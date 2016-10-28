<?php

class LegacyController
{
    /**
     * @var LegacyGateway
     */
    private $gateway;

    public function __construct(LegacyGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    public function performAction(int $userId)
    {
        $user = $this->gateway->findUserById($userId);
        // ...

        print 'something';
    }
}

