<?php

namespace Address\Http {

    use Address\Exceptions\SessionException;

    class Session
    {
        /** @var array  */
        public $data;

        public function __construct(array $session)
        {
            $this->data = $session;
        }

        public function setValue(string $key, $value)
        {
            $this->data[$key] = $value;
        }

        public function getValue(string $key, $default = null)
        {
            if (isset($this->data[$key])) {
                return $this->data[$key];
            }
            return $default;
        }

        public function deleteValue(string $key)
        {
            if (!isset($this->data[$key])) {
                throw new SessionException("Key '$key' does not exist");
            }
            unset($this->data[$key]);
        }

        public function getSessionData() : array
        {
            if ($this->data !== null) {
                return $this->data;
            }
            return array();
        }

        public function isset(string $key) : bool
        {
            return isset($this->data[$key]);
        }
    }
}
