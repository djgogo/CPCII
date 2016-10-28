<?php
declare(strict_types = 1);

class Recognizer
{
    /**
     * @var array
     */
    private $knownMessages;

    public function addKnownMessage(string $msg, Message $message)
    {
        $this->knownMessages[$msg] = $message;
    }

    public function recognize(Message $message) : string
    {
        return array_search($message, $this->knownMessages);
    }
}

