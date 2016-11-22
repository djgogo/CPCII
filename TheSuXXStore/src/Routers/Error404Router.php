<?php

namespace Suxx\Routers
{
    use Suxx\Factories\Factory;
    use Suxx\Http\Request;

    class Error404Router
    {
        /**
         * @var Factory
         */
        private $factory;

        public function __construct(Factory $factory)
        {
            $this->factory = $factory;
        }

        public function route(Request $request)
        {
            return $this->factory->getError404Controller();
        }
    }
}
