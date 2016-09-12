<?php

/**
 * Token Generator
 *
 * Generates a unique hashed token using various sources for random data
 */
class Token
{
    /**
     * @var string
     */
    private $tokenValue = '';

    /**
     * @param string $value
     */
    public function __construct($value = null)
    {
        if ($value !== null) {
            $this->tokenValue = $value;
        } else {
            $this->setValue();
        }
    }

    /**
     *
     */
    private function setValue()
    {
        $source = file_get_contents('/dev/urandom', false, null, null, 64);
        $source .= uniqid(uniqid(mt_rand(0, PHP_INT_MAX), true), true);
        for ($t = 0; $t < 64; $t++) {
            $source .= chr((mt_rand() ^ mt_rand()) % 256);
        }
        $this->tokenValue = sha1(hash('sha512', $source, true));
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->tokenValue;
    }
}
