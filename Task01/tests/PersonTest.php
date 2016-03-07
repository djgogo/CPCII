<?php
require_once '../src/Person.php';
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 3/7/16
 * Time: 8:13 AM
 */
class PersonTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Person
     */
    private $person;

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
    private $birhday;

    public function setUp()
    {
        $this->name = 'Peter';
        $this->surname = 'Sacco';
        $this->birthday = '09.03.1968';
        $this->person = new Person($this->name, $this->surname, $this->birhday);
    }

    public function testGetNameWorks()
    {
        $this->assertEquals($this->name, $this->person->getName());
    }

    public function testGetSurnameWorks()
    {
        $this->assertEquals($this->surname, $this->person->getSurname());
    }

    public function testGetBirthday()
    {
        $this->assertEquals($this->birhday, $this->person->getBirthday());
    }

    public function testSetAddress()
    {
        $address = 'Bernerstrasse Nord 152';
        $this->person->setAddress($address);
        $this->assertEquals($address, $this->person->getAddress());
    }

    public function testSetZipcode()
    {
        $zipcode = 8064;
        $this->person->setZipcode($zipcode);
        $this->assertEquals($zipcode, $this->person->getZipcode());
    }

    public function testSetResidence()
    {
        $residence = 'Zürich';
        $this->person->setResidence($residence);
        $this->assertEquals($residence, $this->person->getResidence());
    }

    public function testSetPhoneNumber()
    {
        $phoneNumber = '044-444 44 44';
        $this->person->setPhoneNumber($phoneNumber);
        $this->assertEquals($phoneNumber, $this->person->getPhoneNumber());
    }

    public function testSetfavouriteColor()
    {
        $favouriteColor = 'blue';
        $this->person->setFavouriteColor($favouriteColor);
        $this->assertEquals($favouriteColor, $this->person->getFavouriteColor());
    }

}
