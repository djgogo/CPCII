<?php

namespace Address\Controllers
{
    use Address\Http\Request;
    use Address\Http\Response;

    interface ControllerInterface
    {
        public function execute(Request $request, Response $response);
    }
}
