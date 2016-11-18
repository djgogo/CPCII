<?php

/**
 * @covers SuxxSession
 */
class SuxxSessionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var SuxxSession
     */
    private $session;

    protected function setUp()
    {
        $this->session = new SuxxSession(array());
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
        $this->assertEquals(null, $this->session->getValue('user'));
    }

    public function testDeleteValueThrowsExceptionIfNotFound()
    {
        $this->expectException(SuxxSessionException::class);
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
}
