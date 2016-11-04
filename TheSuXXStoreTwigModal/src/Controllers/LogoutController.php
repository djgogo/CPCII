<?php

class SuxxLogoutController implements SuxxController
{
    public function execute(SuxxRequest $request, SuxxSession $session, SuxxResponse $response)
    {
        unset($session->session);
        session_unset();

        $response->setRedirect('/');
        return;
    }
}
