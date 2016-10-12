<?php

class Recognizer
{
    /**
     * @var array
     */
    private $knownMessages;

    /**
     * @var array
     */
    private $similarMessages = [
        '-..---...',
        '.-.---...',
        '..----...',
        '....--...',
        '...-.-...',
        '...--....',
        '...----..',
        '...---.-.',
        '...---..-'
    ];

    public function addKnownMessage(string $msg, Message $message)
    {
        $this->knownMessages[$msg] = $message;
    }

    public function recognize(Message $message)
    {
        if (!in_array($message, $this->knownMessages) && !in_array($message, $this->similarMessages)) {
            return false;
        }

        return 'SOS';
    }
}

