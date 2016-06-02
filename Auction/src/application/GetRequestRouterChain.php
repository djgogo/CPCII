<?php
declare(strict_types=1);

class GetRequestRouterChain
{
    private $routers = [];

    public function add(GetRequestRouter $router)
    {
        $this->routers[] = $router;
    }
}
