<?php


class Author
{
    /**
     * @var string
     */
    private $name;

    /**
     * Author constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName() : string
    {
        return $this->name;
    }
}
