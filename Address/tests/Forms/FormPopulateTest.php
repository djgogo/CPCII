<?php

namespace Address\Forms {

    use Address\Http\Session;

    /**
     * @covers Address\Forms\FormPopulate
     * @uses Address\Http\Session
     */
    class FormPopulateTest extends \PHPUnit_Framework_TestCase
    {
        /** @var Session | \PHPUnit_Framework_MockObject_MockObject */
        private $session;

        /** @var FormPopulate */
        private $formPopulate;

        protected function setUp()
        {
            $this->session = $this->getMockBuilder(Session::class)->disableOriginalConstructor()->getMock();
            $this->formPopulate = new FormPopulate($this->session);
        }

        public function testFormDataCanBeSetAndRetrieved()
        {
            $this->formPopulate->set('formField', 'formValue');
            $this->assertEquals('formValue', $this->formPopulate->get('formField'));
        }

        public function testHasReturnsRightBoolean()
        {
            $this->formPopulate->set('formField', 'formValue');
            $this->assertTrue($this->formPopulate->has('formField'));
        }

        public function testFormDataCanBeRemoved()
        {
            $this->formPopulate->set('formField', 'formValue');
            $this->assertTrue($this->formPopulate->has('formField'));

            $this->formPopulate->remove('formField');
            $this->assertFalse($this->formPopulate->has('formField'));
        }

        public function testGetFormDataReturnsEmptyStringIfNotFound()
        {
            $this->assertEquals('', $this->formPopulate->get('anyField'));
        }
    }
}
