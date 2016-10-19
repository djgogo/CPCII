<?php

class SuxxLogoutController extends SuxxController
{
    /**
     * @var string
     */
    protected $viewFile = '/../Pages/homepage.xhtml';

    public function execute(SuxxRequest $request, SuxxResponse $response)
    {
        unset($_SESSION['user']);
        session_destroy();

        header('Location: /', 302);
    }
}
