<?php

class SuxxUpdateProductViewController implements SuxxController
{
    /**
     * @var SuxxProductTableDataGateway
     */
    private $productDataGateway;

    public function __construct(SuxxProductTableDataGateway $productDataGateway)
    {
        $this->productDataGateway = $productDataGateway;
    }

    public function execute(SuxxRequest $request, SuxxSession $session, SuxxResponse $response)
    {
        if ($request->getValue('product') === '') {
            return '404errorview.twig';
        }
        $response->setProduct($this->productDataGateway->findProductById($request->getValue('pid')));
        $session->setValue('updateproduct_label', $response->getProduct()->getLabel());
        $session->setValue('updateproduct_price', $response->getProduct()->getPrice());

        return 'updateproductview.twig';
    }

}
