<?php

class SuxxErrorController implements SuxxController
{
    public function execute(SuxxRequest $request, SuxxSession $session, SuxxResponse $response)
    {
        $response->trace = debug_backtrace();
        $response->error = 'An Error occoured:';
        return new SuxxErrorView();
    }
}
