<?php

class SuxxRouter
{
    /**
     * @var Factory
     */
    private $factory;

    public function __construct(SuxxFactory $factory)
    {
        $this->factory = $factory;
    }

    public function route(SuxxRequest $request)
    {
        $uri = $request->getRequestUri();
        switch ($uri) {
            case '/': {
                return $this->factory->getHomeController();
                }
            case '/suxx/login': {
                return $this->factory->getLoginController();
                }
            case '/suxx/register': {
                return $this->factory->getRegisterController();
                }
            case '/suxx/logout': {
                return $this->factory->getLogoutController();
            }
            case '/suxx/product?pid=1': {
                return $this->factory->getProductController();
            }
        }
    }
}

