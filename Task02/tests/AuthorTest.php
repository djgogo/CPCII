<?php

require_once '../src/Author.php';

class AuthorTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Author
     */
    private $author;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $surname;
    /**
     * @var string
     */
    private $email;

    public function setUp()
    {
        $this->name = 'Hans';
        $this->surname = 'Muster';
        $this->email = 'hans@muster.ch';
        $this->author = new Author($this->name, $this->surname, $this->email);
    }

    public function testGetName()
    {
        $this->assertEquals($this->name, $this->author->getName());
    }

    public function testGetSurname()
    {
        $this->assertEquals($this->surname, $this->author->getSurname());
    }

    public function testGetEmail()
    {
        $this->assertEquals($this->email, $this->author->getEmail());
    }
}