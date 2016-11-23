<?php

namespace Suxx\Http {

    use Suxx\Exceptions\RequestValueNotFoundException;
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
            return $this->file;
        }

        public function hasValue($key) : bool
        {
            return isset($this->input[$key]);
        }

        public function getValue($key) : string
        {
            if (!$this->hasValue($key)) {
                throw new RequestValueNotFoundException('Value Not Found');
            }
            return $this->input[$key];
        }
    }
}
