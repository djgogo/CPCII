<?php

namespace Address\Http {

    use Address\Exceptions\SessionException;

    /**
     * @covers Address\Http\Session
     */
    class SessionTest extends \PHPUnit_Framework_TestCase
    {
        /**
         * @var Session
         */
        private $session;

        protected function setUp()
        {
            $this->session = new Session(array());
        }

        public function testValueCanBeSetAndRetrieved()
        {
            $this->session->setValue('user', 'Harry Potter');
            $this->assertEquals('Harry Potter', $this->session->getValue('user'));
        }

        public function testValueCanBeDeleted()
        {
            $this->session->setValue('user', 'Harry Potter');
            $this->session->deleteValue('user');
            $this->assertEquals('', $this->session->getValue('user'));
        }

        public function testDeleteValueThrowsExceptionIfNotFound()
        {
            $this->expectException(SessionException::class);
            $this->session->deleteValue('wrong Key');
        }

        public function testSessionDataCanBeRetrieved()
        {
            $this->session->setValue('user', 'Harry Potter');
            $this->assertEquals(['user' => 'Harry Potter'], $this->session->getSessionData());
        }

        public function testGetSessionReturnsArrayIfNull()
        {
            $this->session->data = null;
            $this->assertEquals([], $this->session->getSessionData());
        }

        public function testIssetReturnsRightBoolean()
        {
            $this->session->setValue('user', 'Harry Potter');
            $this->assertTrue($this->session->isset('user'));
        }

        public function testSessionReturnsIfUserIsLoggedInOrNot()
        {
            $this->session->setValue('user', 'Harry Potter');
            $this->assertTrue($this->session->isLoggedIn());
            $this->session->deleteValue('user');
            $this->assertFalse($this->session->isLoggedIn());
        }
    }
}
