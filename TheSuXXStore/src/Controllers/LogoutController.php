<?php

class SuxxLogoutController implements SuxxController
{
    public function execute(SuxxRequest $request, SuxxResponse $response)
    {
        session_unset();

        $response->setRedirect('/');
        return;
    }
}
