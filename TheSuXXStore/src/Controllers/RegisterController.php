<?php

namespace Suxx\Controllers {

    use Suxx\Commands\RegistrationFormCommand;
    use Suxx\Gateways\ProductTableDataGateway;
    use Suxx\Http\Request;
    use Suxx\Http\Response;

    class RegisterController implements Controller
    {
        /**
         * @var RegistrationFormCommand
         */
        private $registrationFormCommand;

        /**
         * @var ProductTableDataGateway
         */
        private $dataGateway;

        public function __construct(
            RegistrationFormCommand $registrationFormCommand,
            ProductTableDataGateway $dataGateway)
        {
            $this->registrationFormCommand = $registrationFormCommand;
            $this->dataGateway = $dataGateway;
        }

        public function execute(Request $request, Response $response)
        {
            $result = $this->registrationFormCommand->execute($request);

            if ($result === false) {
                return 'register.twig';
            }

            $response->setProducts($this->dataGateway->getAllProducts());
            return 'base.twig';
        }
    }
}
