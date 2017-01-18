<?php

namespace Address\Controllers
{
    use Address\Http\Request;
    use Address\Http\Response;

    interface Controller
    {
        public function execute(Request $request, Response $response);
    }
}
