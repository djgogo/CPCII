<?php

namespace Address\Controllers
{
    use Address\Http\Request;
    use Address\Http\Response;

        class Error404Controller implements Controller
    {
        public function execute(Request $request, Response $response)
        {
            return '404errorview.twig';
        }
    }
}
