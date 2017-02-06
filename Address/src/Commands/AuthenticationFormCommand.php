<?php

namespace Address\Commands {

    use Address\Authentication\Authenticator;
    use Address\Forms\FormError;
    use Address\Forms\FormPopulate;
    use Address\Http\Request;
    use Address\Http\Session;
    use Address\ValueObjects\Id;

    class AuthenticationFormCommand extends AbstractFormCommand
    {
        /** @var Authenticator */
        private $authenticator;

        /** @var FormPopulate */
        private $populate;

        /** @var FormError */
        private $error;

        /** @var string */
        private $username;

        /** @var string */
        private $password;

        public function __construct(
            Authenticator $authenticator,
            Session $session,
            FormPopulate $formPopulate,
            FormError $error)
        {
            parent::__construct($session);

            $this->authenticator = $authenticator;
            $this->populate = $formPopulate;
            $this->error = $error;
        }

        protected function setFormValues(Request $request)
        {
            $this->username = $request->getValue('username');
            $this->password = $request->getValue('password');
        }

        protected function validateRequest()
        {
            if ($this->username === '') {
                $this->error->set('username', 'Bitte geben Sie einen Usernamen ein.');
            }

            if ($this->password === '') {
                $this->error->set('password', 'Bitte geben Sie ein Passwort ein.');
            }
        }

        protected function performAction(): bool
        {
            if ($this->authenticator->authenticate($this->username, $this->password)) {
                $this->getSession()->setValue('message', 'Herzlich Willkommen - Sie können nun Einträge bearbeiten');
                $this->getSession()->setValue('user', $this->username);
                return true;
            }

            $this->getSession()->setValue('warning', 'Log-In fehlgeschlagen!');
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
        }
    }
}

