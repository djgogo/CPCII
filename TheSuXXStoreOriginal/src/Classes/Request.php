<?php

class SuxxRequest
{
    /**
     * @var array
     */
    public $input;

    /**
     * @var array
     */
    public $params;

    /**
     * @var array
     */
    private $files;

    /**
     * @var string
     */
    private $picture;

    public function __construct(array $request, array $files)
    {
        $this->input = $request;
        $this->files = $files;

        if ($this->hasFile('picture')) {
            $this->picture = $this->files['picture']['name'];
            $this->originalPath = $this->files['picture']['tmp_name'];
        } else {
            $this->picture = '';
        }
    }

    public function getRequestUri() : string
    {
        return $_SERVER['REQUEST_URI'];
    }

    public function hasFile($key) : bool
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

    private function escape($string) : string
    {
        return htmlspecialchars($string, ENT_QUOTES);
    }
}
