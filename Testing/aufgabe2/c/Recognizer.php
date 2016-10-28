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
        if (!in_array($message, $this->knownMessages) && similar_text('...---...', $message) <= 7) {
            return false;
        }

        return 'SOS';
    }
}

