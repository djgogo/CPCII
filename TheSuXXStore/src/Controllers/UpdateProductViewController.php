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
        $response->product = $this->productDataGateway->findProductById($request->getValue('pid'));
        $session->setValue('updateproduct_label', $response->product->LABEL);
        $session->setValue('updateproduct_price', $response->product->PRICE);

        return 'updateproductview.twig';
    }

}
