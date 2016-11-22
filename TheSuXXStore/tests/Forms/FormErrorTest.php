<?php

namespace Suxx\Forms {

    use Suxx\Http\Session;

    /**
     * @covers Suxx\Forms\FormError
     * @uses   Suxx\Http\Session
     */
    class FormErrorTest extends \PHPUnit_Framework_TestCase
    {
        /**
         * @var \PHPUnit_Framework_MockObject_MockObject | Session
         */
        private $session;

        /**
         * @var FormError
         */
        private $formError;

        protected function setUp()
        {
            $this->session = $this->getMockBuilder(Session::class)->disableOriginalConstructor()->getMock();
            $this->formError = new FormError($this->session);
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
}
