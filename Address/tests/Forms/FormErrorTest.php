<?php

namespace Address\Forms {

    use Address\Http\Session;

    /**
     * @covers Address\Forms\FormError
     * @uses   Address\Http\Session
     */
    class FormErrorTest extends \PHPUnit_Framework_TestCase
    {
        /** @var Session | \PHPUnit_Framework_MockObject_MockObject */
        private $session;

        /** @var FormError */
        private $formError;

        protected function setUp()
        {
            $this->session = $this->getMockBuilder(Session::class)->disableOriginalConstructor()->getMock();
            $this->formError = new FormError($this->session);
        }

        public function testFormDataCanBeSetAndRetrieved()
        {
            $this->formError->set('formField', 'formValue');
            $this->assertEquals('formValue', $this->formError->get('formField'));
        }

        public function testHasReturnsRightBoolean()
        {
            $this->formError->set('formField', 'formValue');
            $this->assertTrue($this->formError->has('formField'));
        }

        public function testFormDataCanBeRemoved()
        {
            $this->formError->set('formField', 'formValue');
            $this->assertTrue($this->formError->has('formField'));

            $this->formError->remove('formField');
            $this->assertFalse($this->formError->has('formField'));
        }

        public function testGetFormDataReturnsEmptyStringIfNotFound()
        {
            $this->assertEquals('', $this->formError->get('anyField'));
        }
    }
}
