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
    /**
     * @var array
     */
    private $permissions;

    public function __construct(Author $author)
    {
        $this->author = $author;
        $this->addAuthor($author);
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
        if (in_array($post->getAuthor(), $this->permissions)){
            $this->post = $post;
            $this->printPost();
        }else {
            printf("\n****> %s is not authorized to post on this blog - post rejected!!\n", $this->post->getAuthor()->getName());
        }
    }

    public function printPost()
    {
        printf ("\n-- %s : posted from %s", $this->post->getHeading(), $this->post->getAuthor()->getName());
        printf ("\n%s\n", $this->post->getBody());
    }

    public function addAuthor(Author $author)
    {
        $this->permissions[] = $author;
    }
}
