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
            $this->posts[] = $post;
            $this->publishPost($post);
        } else {
            throw new BlogException('Only Owner can post on his blog!');
        }
    }

    private function publishPost(Post $post)
    {
        printf("\n-- %s : posted from %s", $post->getHeading(), $this->author->getName());
        printf("\n%s\n", $post->getBody());
    }
}
