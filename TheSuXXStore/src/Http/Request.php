<?php

namespace Suxx\Http {

    use Suxx\FileHandlers\UploadedFile;

    class Request
    {
        /**
         * @var array
         */
        private $input;

        /**
         * @var UploadedFile
         */
        private $file;

        /**
         * @var array
         */
        private $server;

        public function __construct(array $request, array $server, UploadedFile $file)
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

        public function getUploadedFile() : UploadedFile
        {
            return $this->file->getUploadedFile();
        }

        public function getValue($key, $default = null)
        {
            if (isset($this->input[$key])) {
                return $this->escape($this->input[$key]);
            }
            // Ich hätte wenn $default nicht gesetzt ist und man einen wert will lieber eine exception statt "null" und dann fliegts später aufs gesicht.
            return $default;
        }

        private function escape(string $string) : string //brauchts das noch? wieso?
        {
            return htmlspecialchars($string, ENT_QUOTES);
        }
    }
}
