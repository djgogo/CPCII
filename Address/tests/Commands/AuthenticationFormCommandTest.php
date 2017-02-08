<?php

namespace Address\Commands
{

    use Address\Authentication\Authenticator;
    use Address\Forms\FormError;
    use Address\Forms\FormPopulate;
    use Address\Http\Request;
    use Address\Http\Session;

    /**
     * @covers Address\Commands\AuthenticationFormCommand
     * @uses Address\Authentication\Authenticator
     * @uses Address\Forms\FormError
     * @uses Address\Forms\FormPopulate
     * @uses Address\Http\Session
     * @uses Address\Commands\AbstractFormCommand
     * @uses Address\Http\Request
     * @uses Address\ValueObjects\Password
     * @uses Address\ValueObjects\Username
     */
    class AuthenticationFormCommandTest extends \PHPUnit_Framework_TestCase
    {
        /** @var Authenticator | \PHPUnit_Framework_MockObject_MockObject */
        private $authenticator;

        /** @var Session */
        private $session;

        /** @var FormPopulate */
        private $populate;

        /** @var FormError */
        private $error;

        /** @var AuthenticationFormCommand */
        private $authenticationFormCommand;

        protected function setUp()
        {
            $this->authenticator = $this->getMockBuilder(Authenticator::class)
                ->disableOriginalConstructor()
                ->getMock();

            $this->session = new Session(array());
            $this->populate = new FormPopulate($this->session);
            $this->error = new FormError($this->session);
            $this->authenticationFormCommand = new AuthenticationFormCommand($this->authenticator, $this->session, $this->populate, $this->error);
        }

        /**
         * @dataProvider formFieldProvider
         * @param $fieldToEmpty
         * @param $expectedErrorMessage
         */
        public function testEmptyFormFieldsTriggersError($fieldToEmpty, $expectedErrorMessage)
        {
            $request = ['username' => 'test', 'password' => '123456'];
            $request[$fieldToEmpty] = '';
            $request = new Request($request, array());

            $this->assertFalse($this->authenticationFormCommand->execute($request));
            $this->assertEquals($expectedErrorMessage, $this->session->getValue('error')->get($fieldToEmpty));
        }

        public function formFieldProvider(): array
        {
            return [
                ['username', 'Bitte geben Sie einen Usernamen ein.'],
                ['password', 'Bitte geben Sie ein Passwort ein.'],
            ];
        }

        public function testHappyPath()
        {
            $request = ['username' => 'test', 'password' => '123456'];
            $request = new Request($request, array());

            $this->authenticator
                ->expects($this->once())
                ->method('authenticate')
                ->with($request->getValue('username'), $request->getValue('password'))
                ->willReturn(true);

            $this->assertTrue($this->authenticationFormCommand->execute($request));
            $this->assertEquals('Herzlich Willkommen - Sie können nun Einträge bearbeiten', $this->session->getValue('message'));
        }

        public function testExecutionCanDeleteSessionErrorIfSet()
        {
            $this->session->setValue('error', 'test');

            $request = ['username' => 'suxx', 'password' => '123456'];
            $request = new Request($request, array());

            $this->authenticator
                ->expects($this->once())
                ->method('authenticate')
                ->with($request->getValue('username'), $request->getValue('password'))
                ->willReturn(true);

            $this->assertTrue($this->authenticationFormCommand->execute($request));
            $this->assertEquals('Herzlich Willkommen - Sie können nun Einträge bearbeiten', $this->session->getValue('message'));
        }

        public function testAuthenticationFailsWithWrongCredentials()
        {
            $request = ['username' => 'test', 'password' => 'wrong Password'];
            $request = new Request($request, array());

            $this->authenticator
                ->expects($this->once())
                ->method('authenticate')
                ->with($request->getValue('username'), $request->getValue('password'))
                ->willReturn(false);

            $this->assertTrue($this->authenticationFormCommand->execute($request));
            $this->assertEquals('Log-In fehlgeschlagen!', $this->session->getValue('warning'));
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

        public function formFieldValuesProvider() : array
        {
            return [
                ['username', 'test'],
                ['password', '123456'],
            ];
        }
    }
}
