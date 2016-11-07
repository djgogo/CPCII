<?php

class SuxxComment
{
    /**
     * @var int
     */
    private $cid;

    /**
     * @var int
     */
    private $pid;

    /**
     * @var string
     */
    private $author;

    /**
     * @var string
     */
    private $comment;

    /**
     * @var string
     */
    private $picture;

    public function getCid(): int
    {
        return $this->cid;
    }

    public function getPid(): int
    {
        return $this->pid;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getComment(): string
    {
        return $this->comment;
    }

    public function getPicture(): string
    {
        return $this->picture;
    }
}

