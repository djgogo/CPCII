<?php

namespace Address\Commands
{

    use Address\Http\Request;

    interface FormCommandInterface
    {
        public function execute(Request $request);
    }
}
