<?php

class SuxxLogoutController implements SuxxController
{
    public function execute(SuxxRequest $request, SuxxResponse $response)
    {
        /**
         * Delete all Session Data
         */
        session_destroy();

        /**
         * Delete Session-Id
         */
        if (isset($_SESSION['id'])) {
            unset($_SESSION['id']);
        }

        /**
         * Delete Session-Cookie (PHPSESSID)
         */
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 7000000, '/');
        }

        $response->setRedirect('/');
        return;
    }
}
