<?php

namespace Suxx\Commands {

    use Suxx\Authentication\Authenticator;
    use Suxx\FileHandlers\UploadedFile;
    use Suxx\Forms\FormError;
    use Suxx\Forms\FormPopulate;
    use Suxx\Http\Request;
    use Suxx\Http\Session;

    /**
     * @covers Suxx\Commands\AuthenticationFormCommand
     * @uses   Suxx\Authentication\Authenticator
     * @uses   Suxx\Http\Session
     * @uses   Suxx\Forms\FormError
     * @uses   Suxx\Forms\FormPopulate
     * @uses   Suxx\Http\Request
     */
    class AuthenticationFormCommandTest extends \PHPUnit_Framework_TestCase
    {
        /**
         * @var \PHPUnit_Framework_MockObject_MockObject | Authenticator
         */
        private $authenticator;

        /**
         * @var Session
         */
        private $session;

        /**
         * @var FormPopulate
         */
        private $populate;

        /**
         * @var FormError
         */
        private $error;

        /**
         * @var \PHPUnit_Framework_MockObject_MockObject | UploadedFile
         */
        private $file;

        protected function setUp()
        {
            $this->authenticator = $this->getMockBuilder(Authenticator::class)
                ->disableOriginalConstructor()
                ->getMock();

            $this->file = $this->getMockBuilder(UploadedFile::class)
                ->disableOriginalConstructor()
                ->getMock();

            $this->session = new Session(array());
            $this->populate = new FormPopulate($this->session);
            $this->error = new FormError($this->session);
        }

        /**
         * @dataProvider formFieldProvider
         * @param $fieldToEmpty
         * @param $expectedErrorMessage
         */
        public function testEmptyFormFieldTriggersError($fieldToEmpty, $expectedErrorMessage)
        {
            $request = ['username' => 'suxx', 'password' => '123456'];
            $request[$fieldToEmpty] = '';
            $request = new Request($request, array(), $this->file);

            $authenticationFormCommand = new AuthenticationFormCommand($this->authenticator, $this->session, $this->populate, $this->error); //Wieso wird das nicht im setup initialisiert?
            $this->assertFalse($authenticationFormCommand->execute($request));
            $this->assertEquals($expectedErrorMessage, $this->session->getValue('error')->get($fieldToEmpty));
        }

        public function testHappyPath()
        {
            $request = ['username' => 'suxx', 'password' => '123456'];
            $request = new Request($request, array(), $this->file);

            $this->authenticator
                ->expects($this->once())
                ->method('authenticate')
                ->with($request->getValue('username'), $request->getValue('password'))
                ->willReturn(true);

            $authenticationFormCommand = new AuthenticationFormCommand($this->authenticator, $this->session, $this->populate, $this->error);
            $this->assertTrue($authenticationFormCommand->execute($request));
            $this->assertEquals('Willkommen - Du bist eingeloggt!', $this->session->getValue('message'));
        }

        public function testExecutionCanDeleteSessionErrorIfSet()
        {
            $this->session->setValue('error', 'test');

            $request = ['username' => 'suxx', 'password' => '123456'];
            $request = new Request($request, array(), $this->file);

            $this->authenticator
                ->expects($this->once())
                ->method('authenticate')
                ->with($request->getValue('username'), $request->getValue('password'))
                ->willReturn(true);

            $authenticationFormCommand = new AuthenticationFormCommand($this->authenticator, $this->session, $this->populate, $this->error);
            $this->assertTrue($authenticationFormCommand->execute($request));
            $this->assertEquals('Willkommen - Du bist eingeloggt!', $this->session->getValue('message'));
        }

        public function testAuthenticationFailsWithWrongCredentials()
        {
            $request = ['username' => 'suxx', 'password' => 'wrong Password'];
            $request = new Request($request, array(), $this->file);

            $this->authenticator
                ->expects($this->once())
                ->method('authenticate')
                ->with($request->getValue('username'), $request->getValue('password'))
                ->willReturn(false);

            $authenticationFormCommand = new AuthenticationFormCommand($this->authenticator, $this->session, $this->populate, $this->error);
            $this->assertTrue($authenticationFormCommand->execute($request));
            $this->assertEquals('Log-In fehlgeschlagen!', $this->session->getValue('warning'));
        }

        /**
         * @return array
         */
        public function formFieldProvider() : array
        {
            return [
                ['username', 'Bitte geben Sie einen Usernamen ein'],
                ['password', 'Bitte geben Sie ein Passwort ein'],
            ];
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
                ['username', 'suxx'],
                ['password', '123456'],
            ];
        }
    }
}
