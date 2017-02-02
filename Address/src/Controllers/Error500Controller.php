<?php

namespace Address\Controllers
{

    use Address\Http\Request;
    use Address\Http\Response;

    class Error500Controller implements ControllerInterface
    {
        public function execute(Request $request, Response $response): string
        {
            return '/templates/errors/500.twig';
        }
    }
}
