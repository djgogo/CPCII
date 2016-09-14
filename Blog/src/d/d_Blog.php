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
     * @var array
     */
    private $permissions;

    public function __construct(Author $author)
    {
        $this->author = $author;
        $this->addAuthor($author);
    }

    public function addAuthor(Author $author)
    {
        $this->permissions[] = $author;
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
        // only owner or authors with permission can post on the blog
        if (in_array($post->getAuthor(), $this->permissions)) {
            $this->posts[] = $post;
            $this->publishPost($post);
        } else {
            throw new BlogException('not authorized to post on this blog!');
        }
    }

    private function publishPost(Post $post)
    {
        printf("\n-- %s : posted from %s", $post->getHeading(), $post->getAuthor()->getName());
        printf("\n%s\n", $post->getBody());
    }
}
