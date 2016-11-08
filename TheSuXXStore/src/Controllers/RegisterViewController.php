<?php

class SuxxRegisterViewController implements SuxxController
{
    public function execute(SuxxRequest $request, SuxxResponse $response)
    {
        return 'register.twig';
    }
}
