<?php

class Author
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
    private $email;

    /**
     * Author constructor.
     * @param $name
     * @param $surname
     * @param $email
     */
    public function __construct($name, $surname, $email)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getName():string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSurname():string
    {
        return $this->surname;
    }

    /**
     * @return string
     */
    public function getEmail():string
    {
        return $this->email;
    }
}