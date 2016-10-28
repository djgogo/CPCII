<?php

class SuxxLogoutController implements SuxxController
{
    /**
     * @var string
     */
    protected $viewFile = '/../../Pages/homepage.xhtml';

    public function execute(SuxxRequest $request, SuxxSession $session, SuxxResponse $response)
    {
        unset($session->session);
        session_unset();

        $response->setRedirect('/');
        return;
    }
}
