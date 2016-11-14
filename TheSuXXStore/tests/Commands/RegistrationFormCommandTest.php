<?php

/**
 * @covers SuxxRegistrationFormCommand
 * @uses SuxxRegistrator
 * @uses SuxxSession
 * @uses SuxxFormError
 * @uses SuxxFormPopulate
 * @uses SuxxRequest
 * @uses Email
 */
class SuxxRegistrationFormCommandTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var PHPUnit_Framework_MockObject_MockObject | SuxxRegistrator
     */
    private $registrator;

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
     * @var SuxxRegistrationFormCommand
     */
    private $registrationFormCommand;

    protected function setUp()
    {
        $this->registrator = $this->getMockBuilder(SuxxRegistrator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->session = new SuxxSession(array());
        $this->populate = new SuxxFormPopulate($this->session);
        $this->error = new SuxxFormError($this->session);

        $this->registrationFormCommand = new SuxxRegistrationFormCommand(
            $this->registrator,
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
        $request = $this->getValidRequestArray();
        $request[$fieldToEmpty] = '';
        $request = new SuxxRequest($request, array(), array());

        $this->registrationFormCommand = new SuxxRegistrationFormCommand($this->registrator, $this->session, $this->populate, $this->error);
        $this->assertFalse($this->registrationFormCommand->execute($request));
        $this->assertEquals($expectedErrorMessage, $this->session->getValue('error')->get($fieldToEmpty));
        $this->assertEquals($request->getValue($fieldToEmpty), $this->session->getValue('populate')->get($fieldToEmpty));
    }

    public function testInvalidPasswordTriggersError()
    {
        $expectedErrorMessage = 'Das Passwort muss mindestens 6 Zeichen lang sein';

        $request = $this->getValidRequestArray();
        $request['password'] = 123;
        $request = new SuxxRequest($request, array(), array());

        $this->registrationFormCommand = new SuxxRegistrationFormCommand($this->registrator, $this->session, $this->populate, $this->error);
        $this->assertFalse($this->registrationFormCommand->execute($request));
        $this->assertEquals($expectedErrorMessage, $this->session->getValue('error')->get('password'));
        $this->assertEquals($request->getValue('password'), $this->session->getValue('populate')->get('password'));
    }

    public function testInvalidEmailTriggersError()
    {
        $expectedErrorMessage = 'Bitte geben Sie eine gültige Email-Adresse ein';

        $request = $this->getValidRequestArray();
        $request['email'] = 'wrong Email';
        $request = new SuxxRequest($request, array(), array());

        $this->registrationFormCommand = new SuxxRegistrationFormCommand($this->registrator, $this->session, $this->populate, $this->error);
        $this->assertFalse($this->registrationFormCommand->execute($request));
        $this->assertEquals($expectedErrorMessage, $this->session->getValue('error')->get('email'));
        $this->assertEquals($request->getValue('email'), $this->session->getValue('populate')->get('email'));
    }

    public function testAlreadyExistingUsernameTriggersError()
    {
        $expectedErrorMessage = 'Username bereits vergeben!';

        $request = $this->getValidRequestArray();
        $request['username'] = 'test';
        $request = new SuxxRequest($request, array(), array());

        $this->registrator
            ->expects($this->once())
            ->method('usernameExists')
            ->willReturn(true);

        $this->registrationFormCommand = new SuxxRegistrationFormCommand($this->registrator, $this->session, $this->populate, $this->error);
        $this->assertFalse($this->registrationFormCommand->execute($request));
        $this->assertEquals($expectedErrorMessage, $this->session->getValue('error')->get('username'));
        $this->assertEquals($request->getValue('username'), $this->session->getValue('populate')->get('username'));
    }

    public function testHappyPath()
    {
        $expectedMessage = 'Vielen Dank für die Anmeldung - Loggen Sie sich bitte ein';

        $request = $this->getValidRequestArray();
        $request = new SuxxRequest($request, array(), array());

        $this->registrator
            ->expects($this->once())
            ->method('register')
            ->willReturn(true);

        $this->registrationFormCommand = new SuxxRegistrationFormCommand($this->registrator, $this->session, $this->populate, $this->error);
        $this->assertTrue($this->registrationFormCommand->execute($request));
        $this->assertEquals($expectedMessage, $this->session->getValue('message'));
    }

    public function testRegistrationFailsTriggersErrorMessage()
    {
        $expectedMessage = 'Anmeldung fehlgeschlagen!';

        $request = $this->getValidRequestArray();
        $request = new SuxxRequest($request, array(), array());

        $this->registrator
            ->expects($this->once())
            ->method('register')
            ->willReturn(false);

        $this->registrationFormCommand = new SuxxRegistrationFormCommand($this->registrator, $this->session, $this->populate, $this->error);
        $this->assertTrue($this->registrationFormCommand->execute($request));
        $this->assertEquals($expectedMessage, $this->session->getValue('warning'));
    }

    /**
     * @return array
     */
    public function formFieldProvider() : array
    {
        return [
            ['username', 'Bitte geben Sie einen Usernamen ein'],
            ['password', 'Bitte geben Sie ein Passwort ein'],
            ['name', 'Bitte geben Sie einen Namen ein'],
            ['email', 'Bitte geben Sie eine gültige Email-Adresse ein'],
        ];
    }

    private function getValidRequestArray() : array
    {
        return [
            'username' => 'suxx',
            'password' => '123456',
            'name' => 'suxx store',
            'email' => 'suxx@store.com'
        ];
    }
}
