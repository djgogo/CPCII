<?php

class SuxxStaticPageRouter
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
        $path = parse_url($uri)['path'];

        switch ($path) {
            case '/':
                return $this->factory->getHomeController();
            case '/suxx/product':
                return $this->factory->getProductController();
            default:
                return $this->factory->get404Controller();
        }
    }
}

