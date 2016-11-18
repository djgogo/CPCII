<?php

class SuxxLoginViewController implements SuxxController
{
    /**
     * @var SuxxSession
     */
    private $session;

    public function __construct(SuxxSession $session)
    {
        $this->session = $session;
    }
    public function execute(SuxxRequest $request, SuxxResponse $response)
    {
        if ($this->session->isset('error')) {
            $this->session->deleteValue('error');
        }

        return 'login.twig';
    }
}
