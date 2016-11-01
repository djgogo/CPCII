<?php

class SuxxRegisterModalController implements SuxxController
{
    public function execute(SuxxRequest $request, SuxxSession $session, SuxxResponse $response)
    {
        return 'register.twig';
    }
}
