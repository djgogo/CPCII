<?php

class SuxxRouter
{
    /**
     * @var Factory
     */
    private $factory;

    /**
     * @var SuxxSession
     */
    private $session;

    public function __construct(SuxxFactory $factory, SuxxSession $session)
    {
        $this->factory = $factory;
        $this->session = $session;
    }

    public function route(SuxxRequest $request)
    {
        $uri = $request->getRequestUri();
        $path = parse_url($uri)['path'];

        switch ($path) {
            case '/':
                return $this->factory->getHomeController();
            case '/suxx/login':
                if ($this->hasCsrfError($request)) {
                    return $this->factory->getErrorController();
                }
                return $this->factory->getLoginController();
            case '/suxx/register':
                return $this->factory->getRegisterController();
            case '/suxx/logout':
                return $this->factory->getLogoutController();
            case '/suxx/product':
                return $this->factory->getProductController();
            case '/suxx/comment':
                if ($this->hasCsrfError($request)) {
                    return $this->factory->getErrorController();
                }
                return $this->factory->getCommentController();
            default:
                return $this->factory->get404Controller();
        }
    }

    protected function hasCsrfError(SuxxRequest $request)
    {
        if ($request->getValue('csrf') != $this->session->getValue('token')) {
            $this->session->setValue('error', 'Das übergebene Formular hat kein gültiges CSRF-Token!');
            return true;
        }
        return false;
    }
}

