<?php
declare(strict_types=1);

class PostRequestRouterChain
{
    private $routers = [];

    public function add(PostRequestRouter $router)
    {
        $this->routers[] = $router;
    }

    public function route(Request $request, Session $session)
    {
        foreach ($this->routers as $router) {
            if ($router->canRoute($request, $session)) {
                return $router->route($request, $session);
            }
        }
    }
}
