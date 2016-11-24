<?php

namespace Suxx\Controllers
{
    use Suxx\Http\Request;
    use Suxx\Http\Response;

        class Error500Controller implements Controller
    {
        public function execute(Request $request, Response $response)
        {
            return '500errorview.twig';
        }
    }
}
