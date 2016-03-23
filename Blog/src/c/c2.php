<?php

class Blog
{
    /**
     * @var Author
     */
    private $author;
    /**
     * @var string
     */
    private $title;
    /**
     * @var Post
     */
    private $post;

    public function __construct(Author $author)
    {
        $this->author = $author;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function addPost(Post $post)
    {
        $this->post = $post;
    }

    public function postMessage()
    {
        printf ("\n-- %s : posted from %s", $this->post->getHeading(), $this->author->getName());
        printf ("\n%s\n", $this->post->getBody());
    }
}