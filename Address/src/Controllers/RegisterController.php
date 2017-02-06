<?php

namespace Address\Controllers {

    use Address\Commands\RegistrationFormCommand;
    use Address\Gateways\AddressTableDataGateway;
    use Address\Http\Request;
    use Address\Http\Response;

    class RegisterController implements ControllerInterface
    {
        /**
         * @var RegistrationFormCommand
         */
        private $registrationFormCommand;

        /**
         * @var AddressTableDataGateway
         */
        private $dataGateway;

        public function __construct(
            RegistrationFormCommand $registrationFormCommand,
            AddressTableDataGateway $dataGateway)
        {
            $this->registrationFormCommand = $registrationFormCommand;
            $this->dataGateway = $dataGateway;
        }

        public function execute(Request $request, Response $response)
        {
            if (!$this->registrationFormCommand->execute($request)) {
                return 'authentication/register.twig';
            }

            $response->setAddresses(...$this->dataGateway->getAllAddresses());
            return 'home.twig';
        }
    }
}
