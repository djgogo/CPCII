<?php

class RedirectProcessor implements ProcessorInterface {

    /**
     * @var string
     */
    private $uri;

    /**
     * @param string $uri
     */
    public function __construct($uri) {
        $this->uri = $uri;
    }

    public function execute(HttpRequest $request) {
        return new Url($this->uri);
    }

}
