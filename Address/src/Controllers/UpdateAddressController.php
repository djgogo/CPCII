<?php

namespace Address\Controllers
{

    use Address\Commands\UpdateAddressFormCommand;
    use Address\Gateways\AddressTableDataGateway;
    use Address\Http\Request;
    use Address\Http\Response;

    class UpdateAddressController implements ControllerInterface
    {
        /** @var AddressTableDataGateway */
        private $addressDataGateway;

        /** @var UpdateAddressFormCommand */
        private $updateAddressFormCommand;

        public function __construct(
            UpdateAddressFormCommand $updateAddressFormCommand,
            AddressTableDataGateway $addressDataGateway)
        {
            $this->addressDataGateway = $addressDataGateway;
            $this->updateAddressFormCommand = $updateAddressFormCommand;
        }

        public function execute(Request $request, Response $response)
        {
            if (!$this->updateAddressFormCommand->execute($request)) {
                $response->setAddress($this->addressDataGateway->findAddressById($request->getValue('id')));
                return 'addresses/updateaddress.twig';
            }

            $response->setAddresses(...$this->addressDataGateway->getAllAddresses());
            $response->setRedirect('/');
        }
    }
}
