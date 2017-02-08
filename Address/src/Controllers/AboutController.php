<?php

namespace Address\Controllers
{

    use Address\Http\Request;
    use Address\Http\Response;

    class AboutController implements ControllerInterface
    {
        public function execute(Request $request, Response $response): string
        {
            return 'about.twig';
        }
    }
}
