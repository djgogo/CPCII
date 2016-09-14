<?php
declare(strict_types = 1);

abstract class AbstractLocationHeader
{
    /**
     * @var URL
     */
    protected $url;

    public function __construct(URL $url)
    {
        $this->url = $url;
    }

    abstract protected function send();

    public function __toString() : string
    {
        return (string) $this->url;
    }
}
