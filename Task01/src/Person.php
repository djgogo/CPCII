<?php

class Person
{
    /**
     * @var string name
     * @var string surname
     * @var string address
     * @var int zipcode
     * @var string residence
     * @var string birthday
     * @var string phoneNumber
     * @var string favouriteColor
     */
    private $name;
    private $surname;
    private $address;
    private $zipcode;
    private $residence;
    private $birthday;
    private $phoneNumber;
    private $favouriteColor;
    private $hasCalled = false;

    /**
     * Person constructor.
     * @param string $name
     * @param string $surname
     * @param $birthday
     */
    public function __construct($name, $surname, $birthday)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->birthday = $birthday;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return int
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * @param int $zipcode
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;
    }

    /**
     * @return string
     */
    public function getResidence()
    {
        return $this->residence;
    }

    /**
     * @param string $residence
     */
    public function setResidence($residence)
    {
        $this->residence = $residence;
    }

    /**
     * @return mixed
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @return string
     */
    public function getPhoneNumber()
    {
        $this->hasCalled = true;
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return string
     */
    public function getFavouriteColor()
    {
        return $this->favouriteColor;
    }

    /**
     * @param string $favouriteColor
     */
    public function setFavouriteColor($favouriteColor)
    {
        $this->favouriteColor = $favouriteColor;
    }

    public function askedForTelNumber()
    {
        if ($this->hasCalled) {
            return true;
        }
    }
}