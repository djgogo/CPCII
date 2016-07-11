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
     * @var Comment
     */
    private $commentComment;

    /**
     * Comment constructor.
     * @param Author $author
     */
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

    public function getAuthor() : Author
    {
        return $this->author;
    }

    public function addComment(Comment $comment)
    {
        $this->commentComment = $comment;
        $this->printComment();
    }

    public function printComment()
    {
        printf ("\n========= Comment from %s", $this->commentComment->getAuthor()->getName());
        printf ("\n          %s\n", $this->commentComment->getCommentText());
    }
}
