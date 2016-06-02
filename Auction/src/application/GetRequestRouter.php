<?php
declare(strict_types=1);

interface GetRequestRouter
{
    public function canRoute(GetRequest $request, Session $session) : bool;

    public function route(GetRequest $request, Session $session) : Query;
}
