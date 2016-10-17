<?php
class Router
{
    /**
     * @var Factory
     */
    private $factory;

    /**
     * @param Factory $factory
     */
    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    public function route(HttpRequest $request)
    {
        $uri = $request->getRequestUri();
        switch ($uri) {
            case '/login/check': {
                return $this->factory->getLoginProcessor();
                }
            case '/password/change/check': {
                $session = $this->factory->getSession();
                if (!$session->hasKey('userId')) {
                    return $this->factory->getRedirectProcessor('/login');
                }
                return $this->factory->getPasswordChangeProcessor();
                }
            case '/password/lost/step1/check': {
                return $this->factory->getPasswordLostProcessor();
                }
            case '/secure': {
                $session = $this->factory->getSession();
                if (!$session->hasKey('userId')) {
                    return $this->factory->getRedirectProcessor('/login');
                }
                return $this->factory->getSecurePageProcessor();
                }
        }
    }
}
