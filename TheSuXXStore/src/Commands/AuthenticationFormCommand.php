<?php

namespace Suxx\Commands {

    use Suxx\Authentication\Authenticator;
    use Suxx\Http\Session;
    use Suxx\Http\Request;
    use Suxx\Forms\FormError;
    use Suxx\Forms\FormPopulate;

    class AuthenticationFormCommand extends AbstractFormCommand
    {
        /**
         * @var Session
         */
        private $session;

        /**
         * @var Authenticator
         */
        private $authenticator;

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

        public function __construct(Authenticator $authenticator, Session $session, FormPopulate $formPopulate, FormError $error)
        {
            $this->session = $session;
            $this->authenticator = $authenticator;
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

            if ($this->password === '') {
                $this->error->set('password', 'Bitte geben Sie ein Passwort ein');
            }
        }

        protected function performAction(): bool
        {
            if ($this->authenticator->authenticate($this->username, $this->password)) {
                $this->session->setValue('message', 'Willkommen - Du bist eingeloggt!');
                $this->session->setValue('user', $this->username);
                return true;
            } else {
                $this->session->setValue('warning', 'Log-In fehlgeschlagen!');
                return false;
            }
        }

        protected function hasErrors() : bool
        {
            if ($this->session->isset('error')) {
                return true;
            }
            return false;
        }

        public function repopulateForm()
        {
            if ($this->username !== '') {
                $this->populate->set('username', $this->username);
            }

            if ($this->password !== '') {
                $this->populate->set('password', $this->password);
            }
        }
    }
}

