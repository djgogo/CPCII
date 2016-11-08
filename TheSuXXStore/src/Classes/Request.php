<?php

class SuxxRequest
{
    /**
     * @var array
     */
    private $input;

    /**
     * @var array
     */
    private $params;

    /**
     * @var array
     */
    private $files;

    /**
     * @var array
     */
    private $server;

    /**
     * @var string
     */
    private $picture;

    public function __construct(array $request, array $server, array $files)
    {
        $this->input = $request;
        $this->files = $files;
        $this->server = $server;

        if ($this->hasFile('picture')) {
            $this->picture = $this->files['picture']['name'];
            $this->originalPath = $this->files['picture']['tmp_name'];
        } else {
            $this->picture = '';
        }
    }

    public function getRequestUri() : string
    {
        return $this->server['REQUEST_URI'];
    }

    public function getRequestMethod() : string
    {
        return $this->server['REQUEST_METHOD'];
    }

    public function isPostRequest() : bool
    {
        return ($this->getRequestMethod() == 'POST');
    }

    public function isGetRequest() : bool
    {
        return ($this->getRequestMethod() == 'GET');
    }

    public function hasFile(string $key) : bool
    {
        return isset($this->files[$key]);
    }

    public function getFile() : string
    {
        return $this->picture;
    }

    public function getFilePath() : string
    {
        return $this->originalPath;
    }

    public function setParams(Array $params)
    {
        $this->params = $params;
    }

    public function setParam(string $key, $value)
    {
        $this->params[$key] = $value;
    }

    public function getValue($key, $default = null)
    {
        if (isset($this->input[$key])) {
            return $this->escape($this->input[$key]);
        }

        if (isset($this->params[$key])) {
            return $this->escape($this->params[$key]);
        }

        if (isset($this->files[$key])) {
            return $this->escape($this->files[$key]);
        }

        return $default;
    }

    private function escape(string $string) : string
    {
        return htmlspecialchars($string, ENT_QUOTES);
    }
}
