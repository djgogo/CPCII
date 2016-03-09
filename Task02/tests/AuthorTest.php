<?php

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

    /**
     * @dataProvider provideInvalidEMailAdresses
     */
    public function testInvalidEMailAdressThrowsException($email)
    {
        $this->expectException(InvalidArgumentException::class);
        new Author('any', 'name', $email);
    }

    public function provideInvalidEMailAdresses()
    {
        return array(
            array('invalid@'),
            array('test@dsfdsf'),
            array(''),
            array(213),
        );
    }

    /**
     * @dataProvider provideValidEmailAdresses
     */
    public function testValidEmailAdressesCanBePassed($email)
    {
        $author = new Author('any', 'name', $email);
        $this->assertEquals($email, $author->getEmail());
    }

    public function provideValidEmailAdresses()
    {
        return array(
            array('peter.sacco@competec.ch'),
            array('foo.bar@competec.ch'),
        );
    }


}