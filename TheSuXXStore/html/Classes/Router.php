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

        if ($this->hasCsrfError($request)) {
            // TODO CSRF token handling
            //message 'Das übergebene Formular hat kein gültiges CSRF-Token. Uri: "%s"', $uri)));
            //return $this->factory->getErrorController);
        }

        switch ($path) {
            case '/':
                return $this->factory->getHomeController();
            case '/suxx/login':
                return $this->factory->getLoginController();
            case '/suxx/register':
                return $this->factory->getRegisterController();
            case '/suxx/logout':
                return $this->factory->getLogoutController();
            case '/suxx/product':
                return $this->factory->getProductController();
            case '/suxx/comment':
                return $this->factory->getCommentController();
            default:
                return $this->factory->get404Controller();
        }
    }

    protected function hasCsrfError(SuxxRequest $request)
    {
        return !$request->getValue('csrf');
    }
}

