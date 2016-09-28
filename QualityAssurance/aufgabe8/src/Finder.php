<?php
declare(strict_types = 1);

use PhpParser\Error;
use PhpParser\ParserFactory;

class Finder
{
    /**
     * @var ParserFactory
     */
    private $parser;

    /**
     * @var Error
     */
    private $error;

    public function __construct(ParserFactory $parser, Error $error)
    {
        $this->parser = $parser;
        $this->error = $error;
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
        // Grab the contents of the file
        $code = file_get_contents(__DIR__ . '/' . $entry);

        try {
            $stmts = $parser->parse($code);
            // $stmts is an array of statement nodes

            // TODO grab the classname out from the Parsers Node Tree
            // https://github.com/nikic/PHP-Parser/blob/master/doc/2_Usage_of_basic_components.markdown

        } catch (Error $e) {
            echo 'Parse Error: ', $e->getMessage();
        }

        return $className;
    }

    public function printClassNames(array $classNames)
    {
        // TODO maybe use pretty printer from the parser?

        foreach ($classNames as $className) {
            printf("Found: %s\n", $className);
        }
    }
}
