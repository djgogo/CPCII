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
        $this->ensureRightNumberOfGroups($isbn);
        $this->ensureRightGroupNumber($isbn);
        $this->ensureRightCheckSum($isbn);
        $this->isbn = $isbn;
    }

    private function ensureRightPrefix(string $isbn)
    {
        $prefix = substr($isbn, 0, 3);
        if (!($prefix == '978' || $prefix == '979')) {
            throw new \InvalidIsbnException("Ungültiges Prefix: $prefix übergeben");
        }
    }

    private function ensureRightNumberOfGroups(string $isbn)
    {
        if (count($this->splitIsbn($isbn)) < 5) {
            throw new \InvalidIsbnException("Ungültiges Länge der ISBN Nummer übergeben");
        }
    }

    private function ensureRightGroupNumber(string $isbn)
    {
        $splittedIsbn = $this->splitIsbn($isbn);

        if ($splittedIsbn[0] === '978') {

            switch (strlen($splittedIsbn[1])) {
                case 1:
                    if ($splittedIsbn[1] === '7') {
                        break;
                    }
                    if ($splittedIsbn[1] < '0' || $splittedIsbn[1] > '5') {
                        throw new InvalidIsbnException("Ungültige Gruppen Nummer: $splittedIsbn[1] übergeben");
                    }
                    break;
                case 2:
                    if ($splittedIsbn[1] < '80' || $splittedIsbn[1] > '94') {
                        throw new InvalidIsbnException("Ungültige Gruppen Nummer: $splittedIsbn[1] übergeben");
                    }
                    break;
                case 3:
                    if ($splittedIsbn[1] >= '600' && $splittedIsbn[1] <= '649') {
                        break;
                    }
                    if ($splittedIsbn[1] < '950' || $splittedIsbn[1] > '989') {
                        throw new InvalidIsbnException("Ungültige Gruppen Nummer: $splittedIsbn[1] übergeben");
                    }
                    break;
                case 4:
                    if ($splittedIsbn[1] < '9900' || $splittedIsbn[1] > '9989') {
                        throw new InvalidIsbnException("Ungültige Gruppen Nummer: $splittedIsbn[1] übergeben");
                    }
                    break;
                case 5:
                    if ($splittedIsbn[1] < '99900' || $splittedIsbn[1] > '99999') {
                        throw new InvalidIsbnException("Ungültige Gruppen Nummer: $splittedIsbn[1] übergeben");
                    }
                    break;
                default:
                    throw new InvalidIsbnException("Ungültige Gruppen Nummer: $splittedIsbn[1] übergeben");
            }

        } elseif ($splittedIsbn[0] === '979') {
            if ($splittedIsbn[1] <10 || $splittedIsbn[1] > 12) {
                throw new InvalidIsbnException("Ungültige Gruppen Nummer: $splittedIsbn[1] übergeben");
            }
        }
    }

    private function ensureRightCheckSum(string $isbn)
    {
        $cleanIsbn = $this->cleanIsbn($isbn);
        $this->ensureRightLength($cleanIsbn);
        $checkSum = substr($cleanIsbn, -1);
        $c = substr($cleanIsbn, 0, -1);

        $sum = (($c[1] + $c[3] + $c[5] + $c[7] + $c[9] + $c[11]) * 3) + ($c[0] + $c[2] + $c[4] + $c[6] + $c[8] + $c[10]);
        $sum = (10 - ($sum % 10)) % 10;

        $check = (string)$sum;

        if ($checkSum !== $check) {
            throw new InvalidIsbnException("Ungültige Prüfziffer: $checkSum ");
        }
    }

    /**
     * @param $isbn
     * @return array
     *  array(5) {
     *    [0] => prefix(3)      978
     *    [1] => groupNo(1)     3
     *    [2] => publisherNo(5) 86680
     *    [3] => titelNo(3)     192
     *    [4] => checkSum(1)    9
     *    }
     */
    private function splitIsbn(string $isbn) : array
    {
        return preg_split("/[-\040]+/", $isbn);
    }

    private function ensureRightLength(string $cleanIsbn)
    {
        if (strlen($cleanIsbn) < 11) {
            throw new InvalidIsbnException("Ungültige Clean-ISBN Länge: $cleanIsbn ");
        }
    }

    private function addHyphens(string $isbn) : string
    {
        return str_replace(' ', '-', $isbn);
    }

    private function cleanIsbn(string $isbn) : string
    {
        return str_replace(['-', ' '], '', $isbn);
    }

    public function compare(ISBN $isbn1, ISBN $isbn2) : bool
    {
        return ($isbn1 == $isbn2);
    }

    public function __toString() : string
    {
        if (!strpos($this->isbn, ' ') === false) {
        return $this->addHyphens($this->isbn);
        }
        return $this->isbn;
    }

}
