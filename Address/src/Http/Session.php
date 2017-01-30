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

        /** @param mixed $value */
        public function setValue(string $key, $value)
        {
            $this->data[$key] = $value;
        }

        public function isset(string $key): bool
        {
            return isset($this->data[$key]);
        }

        /**
         * No Exception will be thrown if Key not found. Template message.twig needs an empty key-value or null if not set.
         * @return mixed|string
         */
        public function getValue(string $key, $default = '')
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

        public function getSessionData(): array
        {
            if ($this->data !== null) {
                return $this->data;
            }
            return array();
        }
    }
}
