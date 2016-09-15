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

    public function __construct(Author $author, string $comment)
    {
        $this->author = $author;
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
