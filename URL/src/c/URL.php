<?php
declare(strict_types = 1);

class URL
{
    /**
     * @var string
     */
    private $url;
    /**
     * @var array
     */
    private $splittedUrl;

    public function __construct(string $url)
    {
        $this->ensureValid($url);
    }

    private function ensureValid(string $url)
    {
        $this->splittedUrl = $this->splitUrl($url);
        $this->ensureAbsoluteUrl($url);
        $this->ensureScheme($url);
        $this->url = $url;
    }

    private function ensureAbsoluteUrl(string $url)
    {
        $urlKeys = array_keys($this->splittedUrl);
        $validUrlKeys = ['scheme', 'host', 'path'];

        foreach ($urlKeys as $urlKey) {
            if (!in_array($urlKey, $validUrlKeys)) {
                throw new \InvalidUrlException("Die übergebene URL: $url ist ungültig");
            }
        }
    }

    private function ensureScheme(string $url)
    {
        $validUrlSchemes = ['HTTP', 'HTTPS'];

        if (!in_array($this->splittedUrl['scheme'], $validUrlSchemes)) {
            throw new \InvalidUrlException("Die übergebene URL hat ein ungültiges Schema: $url");
        }
    }

    public function isSubPathOf(URL $url) : bool
    {
        $urlString = (string) $url;
        $splittedUrl = $this->splitUrl($urlString);

        if (strpos($this->splittedUrl['path'], $splittedUrl['path']) !== false) {
            return true;
        }
        return false;
    }

    public function getSubPath(URL $url) : string
    {
        if ($this->isSubPathOf($url)) {
            return $this->splittedUrl['path'];
        }

        throw new \InvalidUrlException("Falscher URL Pfad: $url");
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
