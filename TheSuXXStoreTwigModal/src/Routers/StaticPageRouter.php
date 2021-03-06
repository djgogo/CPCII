<?php

class SuxxStaticPageRouter
{
    /**
     * @var SuxxFactory
     */
    private $factory;

    public function __construct(SuxxFactory $factory)
    {
        $this->factory = $factory;
    }

    public function route(SuxxRequest $request)
    {
        $uri = $request->getRequestUri();
        $path = parse_url($uri)['path'];

        switch ($path) {
            case '/':
                return $this->factory->getHomeController();
            case '/loginview':
                return $this->factory->getLoginViewController();
            case '/registerview':
                return $this->factory->getRegisterViewController();
            case '/suxx/product':
                return $this->factory->getProductController();
            case '/suxx/logout':
                return $this->factory->getLogoutController();
            default:
                return $this->factory->get404Controller();
        }
    }
}

