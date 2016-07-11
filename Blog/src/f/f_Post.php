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
     * @var Comment
     */
    private $comment;

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

    public function getHeading() : string
    {
        return $this->heading;
    }

    public function getBody() : string
    {
        return $this->body;
    }

    public function getAuthor() : Author
    {
        return $this->author;
    }

    public function addComment(Comment $comment)
    {
        $this->comment = $comment;
        $this->printComment();
    }

    public function printComment()
    {
        printf ("\n==========> Comment from %s", $this->comment->getAuthor()->getName());
        printf ("\n            %s\n", $this->comment->getCommentText());
    }
}
