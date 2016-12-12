<?php

namespace Suxx\Routers
{
    use Suxx\Factories\Factory;
    use Suxx\Http\Request;

    class StaticPageRouter
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
            if (!$request->isGetRequest()) {
                return null;
            }

            $uri = $request->getRequestUri();
            $path = parse_url($uri, PHP_URL_PATH);

            switch ($path) {
                case '/':
                    return $this->factory->getHomeController();
                case '/loginview':
                    return $this->factory->getLoginViewController();
                case '/registerview':
                    return $this->factory->getRegisterViewController();
                case '/suxx/product':
                    return $this->factory->getProductController();
                case '/suxx/updateproductview':
                    return $this->factory->getUpdateProductViewController();
                case '/suxx/logout':
                    return $this->factory->getLogoutController();
                default:
                    return null;
            }
        }
    }
}
