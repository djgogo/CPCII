<?php

namespace Suxx\Controllers {

    use Suxx\Gateways\CommentTableDataGateway;
    use Suxx\Gateways\ProductTableDataGateway;
    use Suxx\Http\Request;
    use Suxx\Http\Response;

    class ProductController implements Controller
    {
        /**
         * @var CommentTableDataGateway
         */
        private $commentDataGateway;

        /**
         * @var ProductTableDataGateway
         */
        private $productDataGateway;

        public function __construct(ProductTableDataGateway $productDataGateway, CommentTableDataGateway $commentDataGateway)
        {
            $this->commentDataGateway = $commentDataGateway;
            $this->productDataGateway = $productDataGateway;
        }

        public function execute(Request $request, Response $response)
        {
            if ($request->getValue('pid') === '') {
                return '404errorview.twig';
            }

            $product = $this->productDataGateway->findProductById($request->getValue('pid'));
            if ($product === false) {
                return '404errorview.twig';
            }
            $response->setProduct($product);
            $response->setComments($this->commentDataGateway->findCommentsByPid($request->getValue('pid')));

            return 'product.twig';
        }

    }
}
