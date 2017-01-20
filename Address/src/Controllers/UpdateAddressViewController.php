<?php

namespace Address\Controllers {

    use Address\Forms\FormPopulate;
    use Address\Gateways\AddressTableDataGateway;
    use Address\Http\Request;
    use Address\Http\Response;
    use Address\Http\Session;

    class UpdateAddressViewController implements ControllerInterface
    {
        /**
         * @var AddressTableDataGateway
         */
        private $addressDataGateway;

        /**
         * @var Session
         */
        private $session;

        /**
         * @var FormPopulate
         */
        private $populate;

        public function __construct(Session $session, AddressTableDataGateway $addressDataGateway, FormPopulate $formPopulate)
        {
            $this->addressDataGateway = $addressDataGateway;
            $this->session = $session;
            $this->populate = $formPopulate;
        }

        public function execute(Request $request, Response $response)
        {
            if ($request->hasValue('address')) {
                if ($request->getValue('address') === '') {
                    return '404.twig';
                }
            }

            $response->setAddress($this->addressDataGateway->findAddressById($request->getValue('id')));
            $this->populate->set('address1', $response->getAddress()->getAddress1());
            $this->populate->set('address2', $response->getAddress()->getAddress2());
            $this->populate->set('city', $response->getAddress()->getCity());
            $this->populate->set('postalCode', $response->getAddress()->getPostalCode());

            if ($this->session->isset('error')) {
                $this->session->deleteValue('error');
            }

            return 'addresses/updateaddress.twig';
        }

    }
}
