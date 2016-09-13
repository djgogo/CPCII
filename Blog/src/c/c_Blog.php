<?php
declare(strict_types = 1);

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

    public function getTitle() : string
    {
        return $this->title;
    }

    public function addPost(Post $post)
    {
        // only owner can post on the blog
        if ($this->author === $post->getAuthor()) {
            $this->post = $post;
            $this->printPost();
        } else {
            throw new BlogException('Only Owner can post on his blog!');
        }
    }

    public function printPost()
    {
        printf("\n-- %s : posted from %s", $this->post->getHeading(), $this->author->getName());
        printf("\n%s\n", $this->post->getBody());
    }
}
