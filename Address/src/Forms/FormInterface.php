<?php

namespace Address\Forms
{
    interface FormInterface
    {
        public function set(string $key, string $value);
        public function has(string $key);
        public function remove(string $key);
        public function get(string $key);
    }
}
