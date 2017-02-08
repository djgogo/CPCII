<?php

namespace Address\Commands
{

    use Address\Authentication\Registrator;
    use Address\Forms\FormError;
    use Address\Forms\FormPopulate;
    use Address\Http\Request;
    use Address\Http\Session;

    /**
     * @covers Address\Commands\RegistrationFormCommand
     * @uses Address\Authentication\Registrator
     * @uses Address\Http\Session
     * @uses Address\Forms\FormError
     * @uses Address\Forms\FormPopulate
     * @uses Address\Http\Request
     * @uses Address\ValueObjects\Email
     * @uses Address\ValueObjects\Password
     * @uses Address\ValueObjects\Username
     * @uses Address\Commands\AbstractFormCommand
     * @uses Address\ParameterObjects\UserParameterObject
     */
    class RegistrationFormCommandTest extends \PHPUnit_Framework_TestCase
    {
        /** @var Registrator | \PHPUnit_Framework_MockObject_MockObject */
        private $registrator;

        /** @var Session */
        private $session;

        /** @var FormPopulate */
        private $populate;

        /** @var FormError */
        private $error;

        /** @var RegistrationFormCommand */
        private $registrationFormCommand;

        protected function setUp()
        {
            $this->registrator = $this->getMockBuilder(Registrator::class)
                ->disableOriginalConstructor()
                ->getMock();

            $this->session = new Session(array());
            $this->populate = new FormPopulate($this->session);
            $this->error = new FormError($this->session);
            $this->registrationFormCommand = new RegistrationFormCommand($this->registrator, $this->session, $this->populate, $this->error);
        }

        public function testHappyPath()
        {
            $expectedMessage = 'Vielen Dank für die Anmeldung - Loggen Sie sich bitte ein.';

            $request = $this->getValidRequestArray();
            $request = new Request($request, array());

            $this->registrator
                ->expects($this->once())
                ->method('register')
                ->willReturn(true);

            $this->assertTrue($this->registrationFormCommand->execute($request));
            $this->assertEquals($expectedMessage, $this->session->getValue('message'));
        }

        public function testExecutionCanDeleteSessionErrorIfSet()
        {
            $this->session->setValue('error', 'test');

            $expectedMessage = 'Vielen Dank für die Anmeldung - Loggen Sie sich bitte ein.';

            $request = $this->getValidRequestArray();
            $request = new Request($request, array());

            $this->registrator
                ->expects($this->once())
                ->method('register')
                ->willReturn(true);

            $this->assertTrue($this->registrationFormCommand->execute($request));
            $this->assertEquals($expectedMessage, $this->session->getValue('message'));
        }

        /**
         * @dataProvider formFieldProvider
         * @param $fieldToEmpty
         * @param $expectedErrorMessage
         */
        public function testEmptyFormFieldTriggersError($fieldToEmpty, $expectedErrorMessage)
        {
            $request = $this->getValidRequestArray();
            $request[$fieldToEmpty] = '';
            $request = new Request($request, array());

            $this->assertFalse($this->registrationFormCommand->execute($request));
            $this->assertEquals($expectedErrorMessage, $this->session->getValue('error')->get($fieldToEmpty));
        }

        public function formFieldProvider(): array
        {
            return [
                ['username', 'Bitte geben Sie einen Benutzernamen ein.'],
                ['password', 'Bitte geben Sie ein Passwort ein.'],
                ['email', 'Bitte geben Sie eine Email Adresse ein.'],
            ];
        }

        public function testInvalidUsernameTriggersError()
        {
            $expectedErrorMessage = 'Der Benutzername darf maximal 50 Zeichen lang sein.';

            $request = $this->getValidRequestArray();
            $request['username'] = str_repeat('x', 51);
            $request = new Request($request, array());

            $this->assertFalse($this->registrationFormCommand->execute($request));
            $this->assertEquals($expectedErrorMessage, $this->session->getValue('error')->get('username'));
        }

        public function testInvalidPasswordTriggersError()
        {
            $expectedErrorMessage = 'Das Passwort muss mindestens 6 und darf maximal 255 Zeichen lang sein.';

            $request = $this->getValidRequestArray();
            $request['password'] = 123;
            $request = new Request($request, array());

            $this->assertFalse($this->registrationFormCommand->execute($request));
            $this->assertEquals($expectedErrorMessage, $this->session->getValue('error')->get('password'));
        }

        public function testInvalidEmailTriggersError()
        {
            $expectedErrorMessage = 'Bitte geben Sie eine gültige Email Adresse ein.';

            $request = $this->getValidRequestArray();
            $request['email'] = 'wrong Email';
            $request = new Request($request, array());

            $this->assertFalse($this->registrationFormCommand->execute($request));
            $this->assertEquals($expectedErrorMessage, $this->session->getValue('error')->get('email'));
        }

        public function testAlreadyExistingUsernameTriggersError()
        {
            $expectedErrorMessage = 'Der gewählte Benutzername ist bereits vergeben!';

            $request = $this->getValidRequestArray();
            $request['username'] = 'test';
            $request = new Request($request, array());

            $this->registrator
                ->expects($this->once())
                ->method('usernameExists')
                ->willReturn(true);

            $this->assertFalse($this->registrationFormCommand->execute($request));
            $this->assertEquals($expectedErrorMessage, $this->session->getValue('error')->get('username'));
        }

        public function testIfRegistrationFailsTriggersErrorMessage()
        {
            $expectedMessage = 'Anmeldung fehlgeschlagen!';

            $request = $this->getValidRequestArray();
            $request = new Request($request, array());

            $this->registrator
                ->expects($this->once())
                ->method('register')
                ->willReturn(false);

            $this->assertTrue($this->registrationFormCommand->execute($request));
            $this->assertEquals($expectedMessage, $this->session->getValue('warning'));
        }

        /**
         * @dataProvider formFieldValuesProvider
         * @param $fieldName
         * @param $fieldValue
         */
        public function testFormFieldsCanBeRepopulated($fieldName, $fieldValue)
        {
            $this->populate->set($fieldName, $fieldValue);
            $this->assertSame($fieldValue, $this->session->getValue('populate')->get($fieldName));
        }

        public function formFieldValuesProvider(): array
        {
            return [
                ['username', 'test'],
                ['password', '123456'],
                ['email', 'test@foo.com']
            ];
        }

        private function getValidRequestArray(): array
        {
            return [
                'username' => 'test',
                'password' => '123456',
                'email' => 'test@foo.com'
            ];
        }
    }
}
