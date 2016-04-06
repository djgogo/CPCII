<?php

class Person
{

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
    private $address;
    /**
     * @var int
     */
    private $zipCode;
    /**
     * @var string
     */
    private $residence;
    /**
     * @var string
     */
    private $birthday;
    /**
     * @var string
     */
    private $phoneNumber;
    /**
     * @var string
     */
    private $favouriteColor;
    /**
     * @var bool
     */
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

    /**
     * @return string
     */
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
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * @param int $zipCode
     * @throws Exception
     */
    public function setZipCode($zipCode)
    {
        if (!$this->zipValidationOk($zipCode)) {
            throw new \InvalidArgumentException("invalid zip code");
        }
        $this->zipCode = $zipCode;
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
     * @return string
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

    /**
     * @return bool
     */
    public function askedForTelNumber()
    {
        return $this->hasCalled;
    }

    public function zipValidationOk($zipCode)
    {
        if(preg_match('/^[0-9]{4}$/', $zipCode) > 0){
            return true;
        }else{
            return false;
        }
    }
}