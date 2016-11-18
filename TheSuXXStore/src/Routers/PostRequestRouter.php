<?php

class SuxxPostRequestRouter
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
        if (!$request->isPostRequest()) {
            return null;
        }

        $uri = $request->getRequestUri();
        $path = parse_url($uri)['path'];

        if ($this->hasCsrfError($request)) {
            return $this->factory->getHomeController();
        }

        switch ($path) {
            case '/suxx/comment':
                return $this->factory->getCommentController();
            case '/suxx/updateproduct';
                return $this->factory->getUpdateProductController();
            default:
                return null;
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

