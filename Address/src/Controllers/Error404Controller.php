<?php

namespace Address\Controllers
{
    use Address\Http\Request;
    use Address\Http\Response;

        class Error404Controller implements ControllerInterface
    {
        public function execute(Request $request, Response $response)
        {
            return '/templates/errors/404.twig';
        }
    }
}
