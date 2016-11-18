<?php

/**
 * @covers SuxxFormError
 * @uses SuxxSession
 */
class SuxxFormErrorTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var PHPUnit_Framework_MockObject_MockObject | SuxxSession
     */
    private $session;

    /**
     * @var SuxxFormError
     */
    private $formError;

    protected function setUp()
    {
        $this->session = $this->getMockBuilder(SuxxSession::class)->disableOriginalConstructor()->getMock();
        $this->formError = new SuxxFormError($this->session);
    }

    public function testFormDataCanBeSetAndRetrieved()
    {
        $this->formError->set('formfield', 'formvalue');
        $this->assertEquals('formvalue', $this->formError->get('formfield'));
    }

    public function testHasReturnsRightBoolean()
    {
        $this->formError->set('formfield', 'formvalue');
        $this->assertTrue($this->formError->has('formfield'));
    }

    public function testFormDataCanBeRemoved()
    {
        $this->formError->set('formfield', 'formvalue');
        $this->assertTrue($this->formError->has('formfield'));

        $this->formError->remove('formfield');
        $this->assertFalse($this->formError->has('formfield'));
    }

    public function testGetFormDataReturnsNullIfNotFound()
    {
        $this->assertEquals(null, $this->formError->get('anyField'));
    }
}
