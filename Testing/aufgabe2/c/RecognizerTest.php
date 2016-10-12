<?php
declare(strict_types = 1);

class RecognizerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Message
     */
    private $sos;

    /**
     * @var Recognizer
     */
    private $recognizer;

    protected function setUp()
    {
        $this->sos = new Message('...---...');

        $this->recognizer = new Recognizer();
        $this->recognizer->addKnownMessage('SOS', $this->sos);
    }

    public function testKnownMessageGetsRecognized()
    {
        $this->assertEquals('SOS', $this->recognizer->recognize($this->sos));
    }

    public function testWrongMessageCanNotBeRecognized()
    {
        $wrongSos = new Message('.-......-.');
        $this->assertFalse($this->recognizer->recognize($wrongSos));
    }

    public function testHustledMessageCanBeRecognized()
    {
        $hustledSos = new Message('.-.---...');
        $this->assertEquals('SOS', $this->recognizer->recognize($hustledSos));
    }
}

