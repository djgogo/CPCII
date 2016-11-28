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

        /**
         * @dataProvider provideProductValues
         */
        public function testPictureCanBeRetrieved($property, $value, $method)
        {
            $reflectionProperty = $this->reflection->getProperty($property);
            $reflectionProperty->setAccessible(true);
            $reflectionProperty->setValue($this->comment, $value);

            $this->assertEquals($value, $this->comment->{$method}());
        }

        public function provideProductValues()
        {
            return [
                ['cid', 123, 'getCid'],
                ['pid', 123, 'getPid'],
                ['author', 'John Doe', 'getAuthor'],
                ['comment', 'Bla Bla', 'getComment'],
                ['picture', 'bla.jpg', 'getPicture']
            ];
        }
    }
}
