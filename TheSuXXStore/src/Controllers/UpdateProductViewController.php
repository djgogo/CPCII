<?php

class SuxxUpdateProductViewController implements SuxxController
{
    /**
     * @var SuxxProductTableDataGateway
     */
    private $productDataGateway;

    /**
     * @var SuxxSession
     */
    private $session;

    public function __construct(SuxxSession $session, SuxxProductTableDataGateway $productDataGateway)
    {
        $this->productDataGateway = $productDataGateway;
        $this->session = $session;
    }

    public function execute(SuxxRequest $request, SuxxResponse $response)
    {
        if ($request->getValue('product') === '') {
            return '404errorview.twig';
        }

        $response->setProduct($this->productDataGateway->findProductById($request->getValue('pid')));
        $this->session->setValue('updateproduct_label', $response->getProduct()->getLabel());
        $this->session->setValue('updateproduct_price', $response->getProduct()->getPrice());
        $this->session->deleteValue('error');

        return 'updateproductview.twig';
    }

}
