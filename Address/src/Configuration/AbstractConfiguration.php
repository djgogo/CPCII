<?php

namespace Address\Configuration
{

    use Address\Exceptions\ConfigurationException;

    abstract class AbstractConfiguration
    {
        /** @var string */
        private $file;

        /** @var array */
        private $settings = [];

        /** @var bool */
        private $isLoaded = false;

        public function __construct(string $file)
        {
            $this->file = $file;
        }

        protected function getValueFromConfig(string $key): string
        {
            $this->loadConfig();

            if (!isset($this->settings[$key])) {
                throw new ConfigurationException('Configuration setting "' . $key . '" does not exist');
            }

            return $this->settings[$key];
        }

        private function loadConfig()
        {
            if ($this->isLoaded) {
                return;
            }

            if (!is_readable($this->file)) {
                throw new ConfigurationException('Cannot read configuration file "' . $this->file . '"');
            }

            $this->isLoaded = true;
            $this->settings = require $this->file;
        }
    }
}
