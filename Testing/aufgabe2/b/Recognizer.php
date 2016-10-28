<?php

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

    public function recognize(Message $message)
    {
        return array_search($message, $this->knownMessages);
    }
}

