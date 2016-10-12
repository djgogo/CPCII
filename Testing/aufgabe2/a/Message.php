<?php
declare(strict_types = 1);

class Message
{
    /**
     * @var string
     */
    private $message;

    public function __construct(string $message)
    {
        $this->message = $message;
    }

    public function __toString() : string
    {
        return (string) $this->message;
    }
}

