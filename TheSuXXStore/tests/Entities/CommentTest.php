<?php

/**
 * @covers SuxxComment
 */
class SuxxCommentTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SuxxComment
     */
    private $comment;

    /**
     * @var ReflectionClass
     */
    private $magic;

    protected function setUp()
    {
        $this->comment = new SuxxComment();
        $this->magic = new ReflectionClass($this->comment);
    }

    public function testCidCanBeRetrieved()
    {
        $reflectionProperty = $this->magic->getProperty('cid');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($this->comment, 123);

        $this->assertEquals(123, $this->comment->getCid());
    }

    public function testPidCanBeRetrieved()
    {
        $reflectionProperty = $this->magic->getProperty('pid');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($this->comment, 123);

        $this->assertEquals(123, $this->comment->getPid());
    }

    public function testAuthorCanBeRetrieved()
    {
        $reflectionProperty = $this->magic->getProperty('author');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($this->comment, 'John Doe');

        $this->assertEquals('John Doe', $this->comment->getAuthor());
    }

    public function testCommentCanBeRetrieved()
    {
        $reflectionProperty = $this->magic->getProperty('comment');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($this->comment, 'Bla Bla');

        $this->assertEquals('Bla Bla', $this->comment->getComment());
    }

    public function testPictureCanBeRetrieved()
    {
        $reflectionProperty = $this->magic->getProperty('picture');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($this->comment, 'bla.jpg');

        $this->assertEquals('bla.jpg', $this->comment->getPicture());
    }
}

