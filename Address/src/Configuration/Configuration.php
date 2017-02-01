<?php

namespace Address\Configuration
{
    class Configuration extends AbstractConfiguration
    {
        public function isProduction(): bool
        {
            return $this->getValueFromConfig('production') === true;
        }

        public function getErrorLogPath(): string
        {
            return $this->getValueFromConfig('errorLogPath');
        }

        public function getTwigTemplatePath(): string
        {
            return $this->getValueFromConfig('twigPath');
        }

        public function getDatabaseHost(): string
        {
            return $this->getValueFromConfig('host');
        }

        public function getDatabaseName(): string
        {
            return $this->getValueFromConfig('database');
        }

        public function getDatabaseUser(): string
        {
            return $this->getValueFromConfig('user');
        }

        public function getDatabasePassword(): string
        {
            return $this->getValueFromConfig('password');
        }

        public function getDatabaseCharset(): string
        {
            return $this->getValueFromConfig('charset');
        }
    }
}
