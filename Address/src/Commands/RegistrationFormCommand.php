<?php

namespace Address\Commands {

    use Address\Authentication\Registrator;
    use Address\Exceptions\InvalidEmailException;
    use Address\Forms\FormError;
    use Address\Forms\FormPopulate;
    use Address\Http\Request;
    use Address\Http\Session;
    use Address\ParameterObjects\UserParameterObject;
    use Address\ValueObjects\Email;

    class RegistrationFormCommand extends AbstractFormCommand
    {
        /** @var Registrator */
        private $registrator;

        /** @var FormPopulate */
        private $populate;

        /** @var FormError */
        private $error;

        /** @var string */
        private $username;

        /** @var string */
        private $password;

        /** @var string */
        private $email;

        public function __construct(
            Registrator $registrator,
            Session $session,
            FormPopulate $formPopulate,
            FormError $error)
        {
            parent::__construct($session);

            $this->registrator = $registrator;
            $this->populate = $formPopulate;
            $this->error = $error;
        }

        protected function setFormValues(Request $request)
        {
            $this->username = $request->getValue('username');
            $this->password = $request->getValue('password');
            $this->email = $request->getValue('email');
        }

        protected function validateRequest()
        {
            if ($this->username === '') {
                $this->error->set('username', 'Bitte geben Sie einen Usernamen ein.');
            }

            if (strlen($this->password) < 6) {
                $this->error->set('password', 'Das Passwort muss mindestens 6 Zeichen lang sein.');
            }

            if ($this->password === '') {
                $this->error->set('password', 'Bitte geben Sie ein Passwort ein.');
            }

            try {
                new Email($this->email);
            } catch (InvalidEmailException $e) {
                $this->error->set('email', 'Bitte geben Sie eine gültige Email Adresse ein.');
            }

            if ($this->email === '') {
                $this->error->set('email', 'Bitte geben Sie eine Email Adresse ein.');
            }
        }

        protected function performAction()
        {
            $userParameter = new UserParameterObject(
                $this->username,
                $this->password,
                $this->email
            );

            if ($this->registrator->register($userParameter)) {
                $this->getSession()->setValue('message', 'Vielen Dank für die Anmeldung - Loggen Sie sich bitte ein');
            } else {
                $this->getSession()->setValue('warning', 'Anmeldung fehlgeschlagen!');
            }
        }

        protected function repopulateForm()
        {
            if ($this->username !== '') {
                $this->populate->set('username', $this->username);
            }

            if ($this->password !== '') {
                $this->populate->set('password', $this->password);
            }

            if ($this->email !== '') {
                $this->populate->set('email', $this->email);
            }
        }
    }
}

