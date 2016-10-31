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
            case '/modallogin':
                return $this->factory->getLoginModalController();
            case '/suxx/product':
                $request->setParam('productDetail', 1);
                return $this->factory->getProductController();
            case '/suxx/logout':
                return $this->factory->getLogoutController();
            default:
                return $this->factory->get404Controller();
        }
    }
}

