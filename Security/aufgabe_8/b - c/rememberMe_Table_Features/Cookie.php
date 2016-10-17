<?php
declare(strict_types = 1);

class Cookie
{
    /**
     * @var string
     */
    private $value;

    /**
     * @var int
     */
    private $expiry;

    /**
     * @var string
     */
    private $name;

    public function set(string $name, string $value)
    {
        $this->name = $name;
        $this->setValue($value);
    }

    public function setValue(string $value)
    {
        $this->value = $value;
    }

    public function getValue() : string
    {
        return $this->value;
    }

    public function setExpiry(int $expiry = 31536000)
    {
        $this->expiry = $expiry;
    }
}


