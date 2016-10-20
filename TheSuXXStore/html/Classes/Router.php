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
        $path = parse_url($uri)['path'];

        switch ($path) {
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
            case '/suxx/product': {
                return $this->factory->getProductController();
                }
            case '/suxx/comment': {
                return $this->factory->getCommentController();
                }
        }
    }
}

