<?php
declare(strict_types=1);

abstract class Request
{
    private $uri;
    private $parameters;

    public function __construct(string $uri, array $parameters)
    {
        $this->uri        = $uri;
        $this->parameters = $parameters;
    }

    public static function fromSuperGlobals() : Request
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            return new GetRequest($_SERVER['REQUEST_URI'], $_GET);
        } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
            return new PostRequest($_SERVER['REQUEST_URI'], $_POST);
        } else {
            // ...
        }
    }

    public function isGetRequest() : bool
    {
        return false;
    }

    public function isPostRequest() : bool
    {
        return false;
    }

    public function getUri() : string
    {
        return $this->uri;
    }

    public function hasParameter(string $parameter) : bool
    {
        return isset($this->parameters[$parameter]);
    }

    public function getParameter(string $parameter) : string
    {
        return $this->parameters[$parameter];
    }
}
