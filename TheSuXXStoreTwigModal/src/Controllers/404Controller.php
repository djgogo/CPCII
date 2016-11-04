<?php

class Suxx404Controller implements SuxxController
{
    public function execute(SuxxRequest $request, SuxxSession $session, SuxxResponse $response)
    {
        return '404errorview.twig';
    }
}
