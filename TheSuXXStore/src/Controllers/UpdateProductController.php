<?php

namespace Suxx\Controllers {

    use Suxx\Commands\UpdateProductFormCommand;
    use Suxx\Gateways\ProductTableDataGateway;
    use Suxx\Http\Request;
    use Suxx\Http\Response;

    class UpdateProductController implements Controller
    {
        /**
         * @var ProductTableDataGateway
         */
        private $productDataGateway;

        /**
         * @var UpdateProductFormCommand
         */
        private $updateProductFormCommand;

        public function __construct(UpdateProductFormCommand $updateProductFormCommand, ProductTableDataGateway $productDataGateway)
        {
            $this->productDataGateway = $productDataGateway;
            $this->updateProductFormCommand = $updateProductFormCommand;
        }

        public function execute(Request $request, Response $response)
        {
            $result = $this->updateProductFormCommand->execute($request);

            if ($result === false) {
                $response->setProduct($this->productDataGateway->findProductById($request->getValue('product-id')));
                $this->updateProductFormCommand->repopulateForm();
                return 'updateproduct.twig';
            }

            $response->setProducts($this->productDataGateway->getAllProducts());
            $response->setRedirect('/');
        }
    }
}
