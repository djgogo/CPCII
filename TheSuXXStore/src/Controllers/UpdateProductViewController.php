<?php

namespace Suxx\Controllers {

    use Suxx\Forms\FormPopulate;
    use Suxx\Gateways\ProductTableDataGateway;
    use Suxx\Http\Request;
    use Suxx\Http\Response;
    use Suxx\Http\Session;

    class UpdateProductViewController implements Controller
    {
        /**
         * @var ProductTableDataGateway
         */
        private $productDataGateway;

        /**
         * @var Session
         */
        private $session;

        /**
         * @var FormPopulate
         */
        private $populate;

        public function __construct(Session $session, ProductTableDataGateway $productDataGateway, FormPopulate $formPopulate)
        {
            $this->productDataGateway = $productDataGateway;
            $this->session = $session;
            $this->populate = $formPopulate;
        }

        public function execute(Request $request, Response $response)
        {
            if ($request->getValue('product') === '') {
                return '404errorview.twig';
            }

            $response->setProduct($this->productDataGateway->findProductById($request->getValue('pid')));
            $this->populate->set('label', $response->getProduct()->getLabel());
            $this->populate->set('price', $response->getProduct()->getPrice());

            if ($this->session->isset('error')) {
                $this->session->deleteValue('error');
            }

            return 'updateproduct.twig';
        }

    }
}
