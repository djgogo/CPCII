<?php

namespace Suxx\Controllers
{
    use Suxx\Http\Request;
    use Suxx\Http\Response;

    interface Controller
    {
        public function execute(Request $request, Response $response);
    }
}
