<?php

class SuxxLoginViewController implements SuxxController
{
    public function execute(SuxxRequest $request, SuxxResponse $response)
    {
        return 'login.twig';
    }
}
