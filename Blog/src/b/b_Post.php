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
     * @var bool
     */
    private $headingOnlyOnce = false;
    /**
     * @var bool
     */
    private $bodyOnlyOnce = false;

    /**
     * @param Author $author
     */
    public function __construct(Author $author)
    {
        $this->author = $author;
    }

    public function addHeading(string $heading)
    {
        if ($this->headingOnlyOnce === false) {
            $this->heading = $heading;
            $this->headingOnlyOnce = true;
        } else {
            throw new PostException('Heading can not be edited!');
        }
    }

    public function addBody(string $body)
    {
        if ($this->bodyOnlyOnce === false) {
            $this->body = $body;
            $this->bodyOnlyOnce = true;
        } else {
            throw new PostException('Body can not be edited!');
        }
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
