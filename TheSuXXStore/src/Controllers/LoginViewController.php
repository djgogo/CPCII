<?php

class SuxxLoginViewController implements SuxxController
{
    public function execute(SuxxRequest $request, SuxxSession $session, SuxxResponse $response)
    {
        return 'login.twig';
    }
}
