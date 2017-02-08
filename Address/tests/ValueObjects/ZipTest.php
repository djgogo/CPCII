<?php

namespace Address\ValueObjects {

    /**
     * @covers \Address\ValueObjects\Zip
     */
    class ZipTest extends \PHPUnit_Framework_TestCase
    {
        public function testHappyPath()
        {
            $zipValue = 4430;
            $zip = new Zip($zipValue);
            $this->assertEquals($zipValue, (string) $zip);
        }

        public function testZipWithLeadingSpaceIsOk()
        {
            $zipValue = ' 4430';
            $zip = new Zip($zipValue);
            $this->assertEquals(trim($zipValue), (string) $zip);
        }

        public function testThrowsExceptionOnZipOutOfSwissZipRange()
        {
            $zip = 12345;
            $this->expectException(\InvalidArgumentException::class);
            new Zip($zip);
        }

        public function testThrowsExceptionOnTooShortZip()
        {
            $zip = 6;
            $this->expectException(\InvalidArgumentException::class);
            new Zip($zip);
        }
    }
}
