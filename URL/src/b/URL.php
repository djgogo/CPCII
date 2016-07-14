<?php
declare(strict_types = 1);

class URL
{
    /**
     * @var string
     */
    private $url;

    public function __construct(string $url)
    {
        $this->ensureValid($url);
    }

    private function ensureValid(string $url)
    {
        $this->ensureAbsoluteUrl($url);
        $this->ensureScheme($url);
        $this->url = $url;
    }

    private function ensureAbsoluteUrl(string $url)
    {
        $splittedUrl = $this->splitUrl($url);

        $urlKeys = array_keys($splittedUrl);
        $validUrlKeys = ['scheme', 'host', 'path'];

        foreach ($urlKeys as $urlKey) {
            if (!in_array($urlKey, $validUrlKeys)) {
                throw new \InvalidUrlException("Die übergebene URL: $url ist ungültig");
            }
        }
    }

    private function ensureScheme(string $url)
    {
        $splittedUrl = $this->splitUrl($url);

        $validUrlSchemes = ['http', 'https'];

        if (!in_array($splittedUrl['scheme'], $validUrlSchemes)) {
            throw new \InvalidUrlException("Die übergebene URL hat ein ungültiges Schema: $url");
        }
    }

    public function equalsTo(URL $url) : bool
    {
        return ($this == $url);
    }

    private function splitUrl(string $url)
    {
        return parse_url($url);
    }

    public function __toString() : string
    {
        return $this->url;
    }
}
