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
    /**
     * @var array
     */
    private $commentComments;

    public function __construct(Author $author, string $comment)
    {
        $this->author = $author;
        $this->comment = $comment;
    }

    public function getCommentText()
    {
        return $this->comment;
    }

    public function getAuthor() : Author
    {
        return $this->author;
    }

    public function addComment(Comment $commentComment)
    {
        $this->commentComments[] = $commentComment;
        $this->publishComment($commentComment);
    }

    public function publishComment(Comment $commentComment)
    {
        printf("\n==================> Comment from %s", $commentComment->getAuthor()->getName());
        printf("\n                    %s\n", $commentComment->getCommentText());
    }
}
