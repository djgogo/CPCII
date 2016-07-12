<?php
declare(strict_types = 1);

class ISBN
{
    /**
     * @var string
     */
    private $isbn;

    public function __construct(string $isbn)
    {
        $this->ensureValid($isbn);
    }

    private function ensureValid($isbn)
    {
        $this->isbn = $isbn;
    }

    public function addHyphens($isbn) : string
    {
        return str_replace(' ', '-', $isbn);
    }

    public function __toString() : string
    {
        if (!strpos($this->isbn, ' ') === false) {
        return $this->addHyphens($this->isbn);
        }
        return $this->isbn;
    }

}
