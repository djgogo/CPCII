<?php

namespace Address\Controllers
{
    use Address\Gateways\AddressTableDataGateway;
    use Address\Http\Request;
    use Address\Http\Response;
    use Address\Http\Session;

    class HomeController implements ControllerInterface
    {
        /**
         * @var Session
         */
        private $session;

        /** @var AddressTableDataGateway */
        private $dataGateway;

        public function __construct(Session $session, AddressTableDataGateway $dataGateway)
        {
            $this->session = $session;
            $this->dataGateway = $dataGateway;
        }

        public function execute(Request $request, Response $response)
        {
            $response->setAddresses($this->dataGateway->getAllAddresses());

            return 'home.twig';
        }
    }
}
