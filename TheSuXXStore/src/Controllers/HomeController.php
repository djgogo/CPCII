<?php

namespace Suxx\Controllers
{
    use Suxx\Gateways\ProductTableDataGateway;
    use Suxx\Http\Request;
    use Suxx\Http\Response;
    use Suxx\Http\Session;

    class HomeController implements Controller
    {
        /**
         * @var Session
         */
        private $session;

        /**
         * @var ProductTableDataGateway
         */
        private $dataGateway;

        public function __construct(Session $session, ProductTableDataGateway $dataGateway)
        {
            $this->session = $session;
            $this->dataGateway = $dataGateway;
        }

        public function execute(Request $request, Response $response)
        {
            switch ($request->getValue('sort')) {
                case 'ASC':
                    $response->setProducts($this->dataGateway->getAllProductsOrderedByUpdatedAscending());
                    $this->session->setValue('sort', 'ASC');
                    break;
                case 'DESC':
                    $response->setProducts($this->dataGateway->getAllProductsOrderedByUpdatedDescending());
                    $this->session->setValue('sort', 'DESC');
                    break;
                default:
                    $response->setProducts($this->dataGateway->getAllProducts());
                    $this->session->setValue('sort', '');
            }

            if ($request->getValue('search')) {
                $response->setProducts($this->dataGateway->getSearchedProduct($request->getValue('search')));
            }

            return 'base.twig';
        }
    }
}
