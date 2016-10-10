<?php

use PhpParser\NodeTraverser;
use PhpParser\ParserFactory;

/**
 * @covers Finder
 * @uses ParserFactory
 * @uses NodeTraverser
 * @uses PhpParser\NodeVisitorAbstract.php
 * @uses MyNodeVisitor
 */
class FinderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $parser;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $traverser;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $finder;

    public function setUp()
    {
        $this->parser = $this->getMockBuilder(ParserFactory::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->traverser = $this->getMockBuilder(NodeTraverser::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->finder = $this->getMockBuilder(Finder::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testCanFindClassNameInGivenDirectory()
    {
        $this->finder
            ->expects($this->once())
            ->method('addTraverser');

        $finder = new Finder($this->parser, $this->traverser);
        $classNames = $finder->findDeclarationsInDirectory('/var/www/Exercises/QualityAssurance/aufgabe8/src');
        $this->assertEquals('Found: MyNodeVisitor  Found: Finder', $finder->printClassNames($classNames));
    }
}
