<?php

namespace Address\Routers
{
    use Address\Http\Request;

    interface RouterInterface
    {
        public function route(Request $request);
    }
}
