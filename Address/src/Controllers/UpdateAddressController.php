<?php

namespace Address\Controllers {

    use Address\Commands\UpdateAddressFormCommand;
    use Address\Gateways\AddressTableDataGateway;
    use Address\Http\Request;
    use Address\Http\Response;

    class UpdateAddressController implements ControllerInterface
    {
        /**
         * @var AddressTableDataGateway
         */
        private $addressDataGateway;

        /**
         * @var UpdateAddressFormCommand
         */
        private $updateAddressFormCommand;

        public function __construct(UpdateAddressFormCommand $updateAddressFormCommand, AddressTableDataGateway $addressDataGateway)
        {
            $this->addressDataGateway = $addressDataGateway;
            $this->updateAddressFormCommand = $updateAddressFormCommand;
        }

        public function execute(Request $request, Response $response)
        {
            $result = $this->updateAddressFormCommand->execute($request);

            if ($result === false) {
                $response->setAddress($this->addressDataGateway->findAddressById($request->getValue('id')));
                $this->updateAddressFormCommand->repopulateForm();
                return 'addresses/updateaddress.twig';
            }

            $response->setAddresses($this->addressDataGateway->getAllAddresses());
            $response->setRedirect('/');
        }
    }
}
