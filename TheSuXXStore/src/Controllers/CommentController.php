<?php

namespace Suxx\Controllers
{
    use Suxx\Commands\CommentFormCommand;
    use Suxx\Http\Request;
    use Suxx\Http\Response;

    class CommentController implements Controller
    {
        /**
         * @var CommentFormCommand
         */
        private $commentFormCommand;

        public function __construct(CommentFormCommand $commentFormCommand)
        {
            $this->commentFormCommand = $commentFormCommand;
        }

        public function execute(Request $request, Response $response)
        {
            $this->commentFormCommand->execute($request);

            $response->setRedirect('/suxx/product?pid=' . $request->getValue('product'));
        }
    }
}
