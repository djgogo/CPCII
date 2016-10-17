<?php

use PhpParser\NodeTraverser;
use PhpParser\ParserFactory;
use PhpParser\NodeVisitorAbstract;

/**
 * @covers Finder2
 * @uses PhpParser\ParserFactory
 * @uses PhpParser\NodeVisitorAbstract
 * @uses MyNodeVisitor
 */
class Finder2Test extends \PHPUnit_Framework_TestCase
{
    public function testCanFindClassNameInGivenDirectory()
    {
        $parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP7);
        $traverser = new NodeTraverser();

        $finder = new Finder2($parser, $traverser);
        $classNames = $finder->findDeclarationsInDirectory('/var/www/Exercises/QualityAssurance/aufgabe8/src');
        $this->assertContains('MyNodeVisitor', $classNames);
        $this->assertContains('Finder2', $classNames);
    }
}
