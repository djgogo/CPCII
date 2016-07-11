<?php
declare(strict_types = 1);

class Comment
{
    /**
     * @var Author
     */
    private $author;
    /**
     * @var string
     */
    private $comment;

    public function __construct(Author $author)
    {
        $this->author = $author;
    }

    public function addCommentText(string $comment)
    {
        $this->comment = $comment;
    }

    public function getCommentText() : string
    {
        return $this->comment;
    }

    public function getAuthor() : Author
    {
        return $this->author;
    }
}
