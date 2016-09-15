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
     * @var array
     */
    private $posts;

    /**
     * @param Author $author
     */
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
        $this->posts[] = $post;
        $this->publishPost($post);
    }

    private function publishPost(Post $post)
    {
        printf("\n-- %s : posted from %s", $post->getHeading(), $this->author->getName());
        printf("\n%s\n", $post->getBody());
    }
}
