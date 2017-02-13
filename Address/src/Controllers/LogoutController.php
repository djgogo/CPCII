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
                setcookie(session_name(), "", 1); // Ensures that cookie expires in browser
                setcookie(session_name(), false); // Removes the cookie
                unset($_COOKIE[session_name()]); // Removes the cookie from the application
            }

            $response->setRedirect('/');
            return;
        }
    }
}
