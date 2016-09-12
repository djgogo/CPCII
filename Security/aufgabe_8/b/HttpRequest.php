<?php
class HttpRequest
{

    private $requestUri;

    private $cookies;
    private $data = array();

    public function __construct(string $requestUrl, array $cookies = array(), array $payload = array())
    {
        $this->requestUri = $requestUrl;
        $this->cookies = $cookies;
        $this->data = $payload;
    }

    public function getRequestUri() : string
    {
        return $this->requestUri;
    }

    public function hasCookie($name)
    {
        return array_key_exists($name, $this->cookies);
    }

    public function getCookie($name) : string
    {
        if (!$this->hasCookie($name)) {
            throw new \RuntimeException("Cookie '$name' not set'");
        }
        return $this->cookies[$name];
    }

    public function setCookie($name, $value)
    {
        $this->cookies[$name] = $value;
    }

    public function hasParameter($name)
    {
        return array_key_exists($name, $this->data);
    }

    public function getParameter($name)
    {
        if (!$this->hasParameter($name)) {
            throw new \RuntimeException("Parameter '$name' not set'");
        }
        return $this->data[$name];
    }

}
