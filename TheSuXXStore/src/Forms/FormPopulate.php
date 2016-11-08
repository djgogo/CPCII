<?php

class SuxxFormPopulate implements SuxxFormInterface
{
    /**
     * @var array
     */
    private $data = [];

    public function set(string $key, string $value)
    {
        $this->data[$key] = $value;
    }

    public function has(string $key)
    {
        return array_key_exists($key, $this->data);
    }

    public function remove(string $key)
    {
        if ($this->has($key)) {
            unset($this->data[$key]);
        }
    }

    public function get(string $key, $default = null)
    {
        if ($this->has($key)) {
            return $this->data[$key];
        }
        return $default;
    }
}
