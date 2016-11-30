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
            if ($request->hasValue('sort')) {
                if ($request->getValue('sort') === 'ASC') {
                    $response->setProducts($this->dataGateway->getAllProductsOrderedByUpdatedAscending());
                    $this->session->setValue('sort', 'ASC');
                } elseif ($request->getValue('sort') === 'DESC') {
                    $response->setProducts($this->dataGateway->getAllProductsOrderedByUpdatedDescending());
                    $this->session->setValue('sort', 'DESC');
                }
            } else {
                $response->setProducts($this->dataGateway->getAllProducts());
                $this->session->setValue('sort', '');
            }

            if ($request->hasValue('search')) {
                $response->setProducts($this->dataGateway->getSearchedProduct($request->getValue('search')));
            }

            return 'base.twig';
        }
    }
}
