<?php

interface SuxxController
{
    public function execute(SuxxRequest $request, SuxxSession $session, SuxxResponse $response);
}
