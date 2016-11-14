<?php

/**
 * @covers SuxxUpdateProductFormCommand
 * @uses SuxxSession
 * @uses SuxxFormError
 * @uses SuxxFormPopulate
 * @uses SuxxRequest
 */
class SuxxUpdateProductFormCommandTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var SuxxSession
     */
    private $session;

    /**
     * @var SuxxFormPopulate
     */
    private $populate;

    /**
     * @var SuxxFormError
     */
    private $error;

    /**
     * @var SuxxUpdateProductFormCommand
     */
    private $updateProductFormCommand;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject | SuxxProductTableDataGateway
     */
    private $dataGateway;

    protected function setUp()
    {
        $this->dataGateway = $this->getMockBuilder(SuxxProductTableDataGateway::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->session = new SuxxSession(array());
        $this->populate = new SuxxFormPopulate($this->session);
        $this->error = new SuxxFormError($this->session);

        $this->updateProductFormCommand = new SuxxUpdateProductFormCommand(
            $this->dataGateway,
            $this->session,
            $this->populate,
            $this->error
        );
    }

    /**
     * @dataProvider formFieldProvider
     * @param $fieldToEmpty
     * @param $expectedErrorMessage
     */
    public function testEmptyFormFieldTriggersErrorAndRepopulate($fieldToEmpty, $expectedErrorMessage)
    {
        $request = ['label' => 'Test Product', 'price' => '123'];
        $request[$fieldToEmpty] = '';
        $request = new SuxxRequest($request, array(), array());

        $this->updateProductFormCommand = new SuxxUpdateProductFormCommand($this->dataGateway, $this->session, $this->populate, $this->error);
        $this->assertFalse($this->updateProductFormCommand->execute($request));
        $this->assertEquals($expectedErrorMessage, $this->session->getValue('error')->get($fieldToEmpty));
        $this->assertEquals($request->getValue($fieldToEmpty), $this->session->getValue('populate')->get($fieldToEmpty));
    }

//    public function testHappyPath()
//    {
//        $request = ['username' => 'suxx', 'password' => '123456'];
//        $request = new SuxxRequest($request, array(), array());
//
//        $this->authenticator
//            ->expects($this->once())
//            ->method('authenticate')
//            ->with($request->getValue('username'), $request->getValue('password'))
//            ->willReturn(true);
//
//        $this->authenticationFormCommand = new SuxxAuthenticationFormCommand($this->authenticator, $this->session, $this->populate, $this->error);
//        $this->assertTrue($this->authenticationFormCommand->execute($request));
//        $this->assertEquals('Willkommen - Du bist eingeloggt!', $this->session->getValue('message'));
//    }
//
//    public function testAuthenticationFailsWithWrongCredentials()
//    {
//        $request = ['username' => 'suxx', 'password' => 'wrong Password'];
//        $request = new SuxxRequest($request, array(), array());
//
//        $this->authenticator
//            ->expects($this->once())
//            ->method('authenticate')
//            ->with($request->getValue('username'), $request->getValue('password'))
//            ->willReturn(false);
//
//        $this->authenticationFormCommand = new SuxxAuthenticationFormCommand($this->authenticator, $this->session, $this->populate, $this->error);
//        $this->assertTrue($this->authenticationFormCommand->execute($request));
//        $this->assertEquals('Log-In fehlgeschlagen!', $this->session->getValue('warning'));
//    }

    /**
     * @return array
     */
    public function formFieldProvider() : array
    {
        return [
            ['label', 'Bitte geben Sie einen Label-Text ein!'],
            ['price', 'Bitte geben Sie einen Preis ein!'],
        ];
    }

}
