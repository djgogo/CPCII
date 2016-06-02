<?php
declare(strict_types=1);

interface PostRequestRouter
{
    public function canRoute(PostRequest $request, Session $session) : bool;

    public function route(PostRequest $request, Session $session) : Command;
}
