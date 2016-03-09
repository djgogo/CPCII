<?php

require_once 'autoload.php';

class BookTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var Book
     */
    private $book;
    /**
     * @var string
     */
    private $titel;
    /**
     * @var Author
     */
    private $author;
    /**
     * @var int
     */
    private $releaseDate;
    /**
     * @var int
     */
    private $numPages;
    /**
     * @var string
     */
    private $genre;

    public function setUp()
    {
        $this->titel = 'Der blaue Elephpant auf Reisen';
        $this->author = new Author('Hans', 'Muster', 'hans@muster.ch');
        $this->releaseDate = 2016;
        $this->numPages = 160;
        $this->genre = 'Science Fiction';
        $this->book = new Book($this->titel,$this->author, $this->releaseDate, $this->numPages, $this->genre);
    }

    public function testgetTitel()
    {
        $this->assertEquals($this->titel, $this->book->getTitel());
    }

    public function testgetAuthor()
    {
        $this->assertEquals($this->author, $this->book->getAuthor());
    }

    public function testgetReleaseDate()
    {
        $this->assertEquals($this->releaseDate, $this->book->getReleaseDate());
    }

    public function testgetNumPages()
    {
        $this->assertEquals($this->numPages, $this->book->getNumPages());
    }

    public function testgetGenre()
    {
        $this->assertEquals($this->genre, $this->book->getGenre());
    }

}
