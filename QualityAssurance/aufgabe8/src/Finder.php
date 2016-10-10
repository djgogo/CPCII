<?php

use PhpParser\Error;
use PhpParser\NodeTraverser;
use PhpParser\Parser as PhpParser;

class Finder
{
    /**
     * @var PhpParser
     */
    private $parser;

    /**
     * @var NodeTraverser
     */
    private $traverser;

    public function __construct(PhpParser $parser, NodeTraverser $traverser)
    {
        $this->parser = $parser;
        $this->traverser = $traverser;
        $this->addTraverser();

        // with big fluent interfaces it can happen that PHP-Parser's Traverser
        // exceeds the 100 recursions limit; set it to 3000 to be sure.
        ini_set('xdebug.max_nesting_level', 3000);
    }

    private function addTraverser()
    {
        // add my visitor (ClassNameResolver)
        $this->traverser->addVisitor(new MyNodeVisitor());
    }

    public function findDeclarationsInDirectory(string $filePath) : array
    {
        $classNames = [];
        if ($handle = opendir($filePath)) {
            while (($entry = readdir($handle)) !== false) {
                if ($entry != '.' && $entry != '..') {
                    $classNames[] = $this->getClassFromFile($entry);
                }
            }
            closedir($handle);
        }
        return $classNames;
    }

    private function getClassFromFile(string $entry)
    {
        $className = '';
        try {
            // Grab the contents of the file
            $code = file_get_contents(__DIR__ . '/' . $entry);

            // parse
            $stmts = $this->parser->parse($code);

            // traverse
            $stmts = $this->traverser->traverse($stmts);

            $className = end($stmts);

        } catch (Error $e) {
            echo 'Parse Error: ', $e->getMessage();
        }

        return $className;
    }

    public function printClassNames(array $classNames)
    {
        foreach ($classNames as $className) {
            printf("Found: %s\n", $className);
        }
    }
}
