<?php

namespace Suxx\Commands {

    use Suxx\Authentication\Registrator;
    use Suxx\Forms\FormError;
    use Suxx\Forms\FormPopulate;
    use Suxx\Http\Session;
    use Suxx\Http\Request;
    use Suxx\ValueObjects\Email;

    class RegistrationFormCommand extends AbstractFormCommand
    {
        /**
         * @var Session
         */
        private $session;

        /**
         * @var Registrator
         */
        private $registrator;

        /**
         * @var FormPopulate
         */
        private $populate;

        /**
         * @var FormError
         */
        private $error;

        /**
         * @var string
         */
        private $username;

        /**
         * @var string
         */
        private $password;

        /**
         * @var string
         */
        private $name;

        /**
         * @var string
         */
        private $email;

        public function __construct(Registrator $registrator, Session $session, FormPopulate $formPopulate, FormError $error)
        {
            $this->session = $session;
            $this->registrator = $registrator;
            $this->populate = $formPopulate;
            $this->error = $error;
        }

        public function execute(Request $request)
        {
            if ($this->session->isset('error')) {
                $this->session->deleteValue('error');
            }

            $this->username = $request->getValue('username');
            $this->password = $request->getValue('password');
            $this->name = $request->getValue('name');
            $this->email = $request->getValue('email');

            $this->validateRequest();
            if (!$this->hasErrors()) {
                $this->performAction();
                return true;
            }
            $this->repopulateForm();
            return false;
        }

        protected function validateRequest()
        {
            if ($this->username === '') {
                $this->error->set('username', 'Bitte geben Sie einen Usernamen ein');
            }

            if (strlen($this->password) < 6) {
                $this->error->set('password', 'Das Passwort muss mindestens 6 Zeichen lang sein');
            }

            if ($this->password === '') {
                $this->error->set('password', 'Bitte geben Sie ein Passwort ein');
            }

            if ($this->name === '') {
                $this->error->set('name', 'Bitte geben Sie einen Namen ein');
            }

            try {
                new Email($this->email);
            } catch (\InvalidArgumentException $e) {
                $this->error->set('email', 'Bitte geben Sie eine gültige Email-Adresse ein');
            }

            if ($this->username !== '' && $this->registrator->usernameExists($this->username)) {
                $this->error->set('username', 'Username bereits vergeben!');
            }
        }

        protected function performAction()
        {
            $row = [
                'username' => $this->username,
                'password' => $this->password,
                'email' => $this->email,
                'name' => $this->name,
                'description' => 'Suxx Account',
                'picture' => ''
            ];

            if ($this->registrator->register($row)) {
                $this->session->setValue('message', 'Vielen Dank für die Anmeldung - Loggen Sie sich bitte ein');
            } else {
                $this->session->setValue('warning', 'Anmeldung fehlgeschlagen!');
            }
        }

        protected function hasErrors() : bool
        {
            if ($this->session->isset('error')) {
                return true;
            }
            return false;
        }

        protected function repopulateForm()
        {
            if ($this->username !== '') {
                $this->populate->set('username', $this->username);
            }

            if ($this->password !== '') {
                $this->populate->set('password', $this->password);
            }

            if ($this->name !== '') {
                $this->populate->set('name', $this->name);
            }

            if ($this->email !== '') {
                $this->populate->set('email', $this->email);
            }
        }
    }
}

