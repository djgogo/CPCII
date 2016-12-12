<?php
declare(strict_types = 1);

namespace GetText
{
    use GetText\Exceptions\GetTextFileException;

    /**
     * @covers \GetText\PoParser
     */
    class PoParserTest extends \PHPUnit_Framework_TestCase
    {
        /**
         * @var string
         */
        private $path;

        /**
         * @var PoParser
         */
        private $parser;

        public function setUp()
        {
            $this->path = __DIR__ . '/TestFiles/testMessages.po';
            $this->parser = new PoParser($this->path);
        }

        public function testPoFileCanBeParsed()
        {
            $result = $this->parser->parse();
            $this->assertArrayHasKey('testing', $result);
            $this->assertContains('test', $result);
        }

        public function testParserThrowsExceptionIfFileNotFound()
        {
            $this->expectException(GetTextFileException::class);

            $parser = new PoParser('/TestFiles/anyFile.po');
            $parser->parse();
        }

        public function testParserThrowsExceptionIfFileNotDefined()
        {
            $this->expectException(GetTextFileException::class);

            $parser = new PoParser('');
            $parser->parse();
        }

        public function testParserThrowsExceptionIfFileIsNotPoFile()
        {
            $this->expectException(GetTextFileException::class);

            $parser = new PoParser('/TestFiles/wrongExtension.txt');
            $parser->parse();
        }
    }
}
