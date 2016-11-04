<?php

class SuxxRegisterViewController implements SuxxController
{
    public function execute(SuxxRequest $request, SuxxSession $session, SuxxResponse $response)
    {
        return 'register.twig';
    }
}
