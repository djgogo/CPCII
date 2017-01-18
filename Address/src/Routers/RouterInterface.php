<?php

namespace Address\Routers
{
    use Address\Http\Request;
    use Address\Controllers\Controller;

    interface Router
    {
        public function route(Request $request): Controller;
    }
}
