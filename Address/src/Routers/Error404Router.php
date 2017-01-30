<?php
declare(strict_types = 1);

namespace Address\Routers
{
    use Address\Factories\Factory;
    use Address\Http\Request;

    class Error404Router implements RouterInterface
    {
        /** @var Factory */
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
