<?php

class SuxxRequest
{
    /**
     * @var array
     */
    private $input;

    /**
     * @var SuxxUploadedFile
     */
    private $file;

    /**
     * @var array
     */
    private $server;

    public function __construct(array $request, array $server, SuxxUploadedFile $file)
    {
        $this->input = $request;
        $this->file = $file;
        $this->server = $server;
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

    public function getUploadedFile() : SuxxUploadedFile
    {
        return $this->file->getUploadedFile();
    }

    public function getValue($key, $default = null)
    {
        if (isset($this->input[$key])) {
            return $this->escape($this->input[$key]);
        }
        return $default;
    }

    private function escape(string $string) : string
    {
        return htmlspecialchars($string, ENT_QUOTES);
    }
}
