<?php

namespace Suxx\Controllers {

    use Suxx\Http\Request;
    use Suxx\Http\Response;

    /**
     * @codeCoverageIgnore
     */
    class LogoutController implements Controller
    {
        public function execute(Request $request, Response $response)
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
}
