<?php
declare(strict_types = 1);

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
     * @param Author $author
     */
    public function __construct(Author $author, string $heading, string $body)
    {
        $this->author = $author;
        $this->body = $body;
        $this->heading = $heading;
    }

    public function getHeading() : string
    {
        return $this->heading;
    }

    public function getBody() : string
    {
        return $this->body;
    }
}
