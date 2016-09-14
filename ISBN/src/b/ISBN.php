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

    private function ensureValid(string $isbn)
    {
        $this->ensureRightPrefix($isbn);
        $this->isbn = $isbn;
    }

    private function ensureRightPrefix(string $isbn)
    {
        $prefix = substr($isbn, 0, 3);
        if (!($prefix == '978' || $prefix == '979')) {
            throw new \InvalidIsbnException("Ungültiges Prefix: $prefix übergeben ");
        }
    }

    private function addHyphens(string $isbn) : string
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
