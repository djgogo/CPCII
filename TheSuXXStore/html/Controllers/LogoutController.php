<?php

class SuxxLogoutController implements SuxxController
{
    /**
     * @var string
     */
    protected $viewFile = '/../Pages/homepage.xhtml';

    public function execute(SuxxRequest $request, SuxxSession $session, SuxxResponse $response)
    {
        unset($_SESSION['user']);
        session_destroy();

        header('Location: /', 302);
    }
}
