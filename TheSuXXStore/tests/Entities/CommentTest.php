<?php

namespace Suxx\Entities {

    /**
     * @covers Suxx\Entities\Comment
     */
    class CommentTest extends \PHPUnit_Framework_TestCase
    {
        /**
         * @var Comment
         */
        private $comment;

        /**
         * @var \ReflectionClass
         */
        private $reflection;

        protected function setUp()
        {
            $this->comment = new Comment();
            $this->reflection = new \ReflectionClass($this->comment);
        }

        public function testCidCanBeRetrieved()
        {
            $reflectionProperty = $this->reflection->getProperty('cid');
            $reflectionProperty->setAccessible(true);
            $reflectionProperty->setValue($this->comment, 123);

            $this->assertEquals(123, $this->comment->getCid());
        }

        public function testPidCanBeRetrieved()
        {
            $reflectionProperty = $this->reflection->getProperty('pid');
            $reflectionProperty->setAccessible(true);
            $reflectionProperty->setValue($this->comment, 123);

            $this->assertEquals(123, $this->comment->getPid());
        }

        public function testAuthorCanBeRetrieved()
        {
            $reflectionProperty = $this->reflection->getProperty('author');
            $reflectionProperty->setAccessible(true);
            $reflectionProperty->setValue($this->comment, 'John Doe');

            $this->assertEquals('John Doe', $this->comment->getAuthor());
        }

        public function testCommentCanBeRetrieved()
        {
            $reflectionProperty = $this->reflection->getProperty('comment');
            $reflectionProperty->setAccessible(true);
            $reflectionProperty->setValue($this->comment, 'Bla Bla');

            $this->assertEquals('Bla Bla', $this->comment->getComment());
        }

        public function testPictureCanBeRetrieved()
        {
            $reflectionProperty = $this->reflection->getProperty('picture');
            $reflectionProperty->setAccessible(true);
            $reflectionProperty->setValue($this->comment, 'bla.jpg');

            $this->assertEquals('bla.jpg', $this->comment->getPicture());
        }
    }
}
