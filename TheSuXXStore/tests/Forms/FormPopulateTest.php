<?php

namespace Suxx\Forms {

    use Suxx\Http\Session;

    /**
     * @covers Suxx\Forms\FormPopulate
     * @uses   Suxx\Http\Session
     */
    class FormPopulateTest extends \PHPUnit_Framework_TestCase
    {
        /**
         * @var \PHPUnit_Framework_MockObject_MockObject | Session
         */
        private $session;

        /**
         * @var FormPopulate
         */
        private $formPopulate;

        protected function setUp()
        {
            $this->session = $this->getMockBuilder(Session::class)->disableOriginalConstructor()->getMock();
            $this->formPopulate = new FormPopulate($this->session);
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
}
