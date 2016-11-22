<?php

namespace Suxx\Controllers
{
    use Suxx\Http\Request;
    use Suxx\Http\Response;

        class Error404Controller implements Controller
    {
        public function execute(Request $request, Response $response)
        {
            return '404errorview.twig';
        }
    }
}
