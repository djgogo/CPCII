<?php


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

    public function getCommentText()
    {
        return $this->comment;
    }

    public function getAuthor():Author
    {
        return $this->author;
    }
}