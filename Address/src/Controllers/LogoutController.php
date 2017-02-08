<?php

namespace Address\Controllers {

    use Address\Http\Request;
    use Address\Http\Response;

    /**
     * @codeCoverageIgnore
     */
    class LogoutController implements ControllerInterface
    {
        public function execute(Request $request, Response $response)
        {
            /**
             * Delete all Session Data
             */
            session_destroy();

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
