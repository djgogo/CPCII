<?php

/**
 * Class Author
 */
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
     * @param string $name
     * @param string $surname
     * @param string $email
     */
    public function __construct(string $name, string $surname, string $email)
    {
        $this->name = $name;
        $this->surname = $surname;

        if (!$this->emailValidationOk($email)) {
            throw new \InvalidArgumentException("invalid email address");
        }
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

    /**
     * @param $email
     * @return bool
     */
    public function emailValidationOk($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }else{
            return true;
        }
    }
}