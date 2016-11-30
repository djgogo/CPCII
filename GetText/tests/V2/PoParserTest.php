<?php
declare(strict_types = 1);

namespace GetText\V2
{
    use GetText\Exceptions\GetTextFileException;

    /**
     * @covers \GetText\V2\PoParser
     * @uses \GetText\V2\GetTextEntry
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
            $this->path = __DIR__ . '/../TestFiles/testMessages.po';
            $this->parser = new PoParser($this->path);
        }

        public function testPoFileCanBeParsed()
        {
            /**
             * @var $result GetTextEntry[]
             */
            $result = $this->parser->parse();
            $this->assertSame('testing', $result[0]->getMsgId());
            $this->assertSame('test', $result[0]->getMsgStr());
        }

        public function testParserThrowsExceptionIfFileNotFound()
        {
            $this->expectException(GetTextFileException::class);

            $parser = new PoParser('/../TestFiles/anyFile.po');
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

            $parser = new PoParser('/../TestFiles/wrongExtension.txt');
            $parser->parse();
        }
    }
}
