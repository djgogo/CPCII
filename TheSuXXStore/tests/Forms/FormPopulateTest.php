<?php

/**
 * @covers SuxxFormPopulate
 * @uses SuxxSession
 */
class SuxxFormPopulateTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var PHPUnit_Framework_MockObject_MockObject | SuxxSession
     */
    private $session;

    /**
     * @var SuxxFormPopulate
     */
    private $formPopulate;

    protected function setUp()
    {
        $this->session = $this->getMockBuilder(SuxxSession::class)->disableOriginalConstructor()->getMock();
        $this->formPopulate = new SuxxFormPopulate($this->session);
    }

    public function testFormDataCanBeSetAndRetrieved()
    {
        $this->formPopulate->set('formfield', 'formvalue');
        $this->assertEquals('formvalue', $this->formPopulate->get('formfield'));
    }

    public function testHasReturnsRightBoolean()
    {
        $this->formPopulate->set('formfield', 'formvalue');
        $this->assertTrue($this->formPopulate->has('formfield'));
    }

    public function testFormDataCanBeRemoved()
    {
        $this->formPopulate->set('formfield', 'formvalue');
        $this->assertTrue($this->formPopulate->has('formfield'));

        $this->formPopulate->remove('formfield');
        $this->assertFalse($this->formPopulate->has('formfield'));
    }

    public function testGetFormDataReturnsNullIfNotFound()
    {
        $this->assertEquals(null, $this->formPopulate->get('anyField'));
    }
}
