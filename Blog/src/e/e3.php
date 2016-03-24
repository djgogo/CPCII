<?php


class Post
{
    /**
     * @var Author
     */
    private $author;
    /**
     * @var string
     */
    private $heading;
    /**
     * @var string
     */
    private $body;

    /**
     * Post constructor.
     * @param Author $author
     */
    public function __construct(Author $author  )
    {
        $this->author = $author;
    }

    public function addHeading(string $heading)
    {
        $this->heading = $heading;
    }

    public function addBody(string $body)
    {
        $this->body = $body;
    }

    public function getHeading():string
    {
        return $this->heading;
    }

    public function getBody():string
    {
        return $this->body;
    }

    public function getAuthor():Author
    {
        return $this->author;
    }
}