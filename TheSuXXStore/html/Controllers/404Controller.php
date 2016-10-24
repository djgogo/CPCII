<?php

class Suxx404Controller implements SuxxController
{
    public function execute(SuxxRequest $request, SuxxSession $session, SuxxResponse $response)
    {
        return new SuxxStaticView(__DIR__ . '/../Pages/404errorview.xhtml');
    }
}
