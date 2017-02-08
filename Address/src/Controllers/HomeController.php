<?php

namespace Address\Controllers
{

    use Address\Gateways\AddressTableDataGateway;
    use Address\Http\Request;
    use Address\Http\Response;
    use Address\Http\Session;

    class HomeController implements ControllerInterface
    {
        /** @var Session */
        private $session;

        /** @var AddressTableDataGateway */
        private $dataGateway;

        public function __construct(Session $session, AddressTableDataGateway $dataGateway)
        {
            $this->session = $session;
            $this->dataGateway = $dataGateway;
        }

        public function execute(Request $request, Response $response): string
        {
            if ($request->hasValue('sort')) {
                if ($request->getValue('sort') === 'ASC') {
                    $response->setAddresses(...$this->dataGateway->getAllAddressesOrderedByUpdated('ASC'));
                } elseif ($request->getValue('sort') === 'DESC') {
                    $response->setAddresses(...$this->dataGateway->getAllAddressesOrderedByUpdated('DESC'));
                }
            } else {
                $response->setAddresses(...$this->dataGateway->getAllAddresses());
            }

            if ($request->hasValue('search')) {
                $response->setAddresses(...$this->dataGateway->getSearchedAddress($request->getValue('search')));
            }

            return 'home.twig';
        }
    }
}
