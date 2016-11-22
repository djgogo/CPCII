<?php

namespace Suxx\Controllers
{
    use Suxx\Commands\CommentFormCommand;
    use Suxx\Http\Request;
    use Suxx\Http\Response;
    use Suxx\Http\Session;

    class CommentController implements Controller
    {
        /**
         * @var Session
         */
        private $session;

        /**
         * @var CommentFormCommand
         */
        private $commentFormCommand;

        public function __construct(
            Session $session,
            CommentFormCommand $commentFormCommand)
        {
            $this->session = $session;
            $this->commentFormCommand = $commentFormCommand;
        }

        public function execute(Request $request, Response $response)
        {
            $result = $this->commentFormCommand->execute($request);

            if ($result === false) {
                header('Location: /suxx/product?pid=' . $request->getValue('product'), 302);
            }

            $_SESSION = $this->session->getSessionData();
            header('Location: /suxx/product?pid=' . $request->getValue('product'), 302);

        }
    }
}
