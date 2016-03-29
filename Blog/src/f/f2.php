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
    /**
     * @var Comment
     */
    private $comment;
    /**
     * @var array
     */
    public $permissions;

    public function __construct(Author $author)
    {
        $this->author = $author;
        $this->addAuthorToPermissionList($author);
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function getTitle():string
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
            printf("\n****> %s has no permission to post on this blog!!\n", $post->getAuthor()->getName());
        }
    }

    public function printPost()
    {
        printf ("\n-- %s : posted from %s", $this->post->getHeading(), $this->post->getAuthor()->getName());
        printf ("\n%s\n", $this->post->getBody());
    }

    public function addComment(Comment $comment)
    {
        $this->comment = $comment;
        $this->printComment();
    }

    public function printComment()
    {
        printf ("\n==========> Comment from %s", $this->comment->getAuthor()->getName());
        printf ("\n            %s\n", $this->comment->getCommentText());
    }

    public function addAuthorToPermissionList(Author $author)
    {
        $this->permissions[] = $author;
    }

    public function removeAuthorFromPermissionList(Author $author)
    {
        if (($key = (array_search($author, $this->permissions))) !== false) {
            if ($key > 0) {
                unset($this->permissions[$key]);
            }else {
                printf("\n****> %s is the owner of this blog - deletion rejected!!\n", $this->author->getName());
            }
        }
    }
}