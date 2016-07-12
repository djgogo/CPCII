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
        $this->ensureRightPrefix($isbn);
        $this->ensureRightGroupNumber($isbn);
        $this->isbn = $isbn;
    }

    public function ensureRightPrefix(string $isbn)
    {
        $prefix = substr($isbn, 0, 3);
        if (!($prefix == '978' || $prefix == '979')) {
            throw new \InvalidIsbnException("Ungültiges Prefix: $prefix übergeben ");
        }
    }

    public function ensureRightGroupNumber($isbn)
    {
        $range = [
            ['min' => 0, 'max' => 5],
            ['min' => 7, 'max' => 7],
            ['min' => 80, 'max' => 94],
            ['min' => 600, 'max' => 649],
            ['min' => 950, 'max' => 989],
            ['min' => 9900, 'max' => 9989],
            ['min' => 99900, 'max' => 99999],

        ];
    }

    public function addHyphens(string $isbn) : string
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
