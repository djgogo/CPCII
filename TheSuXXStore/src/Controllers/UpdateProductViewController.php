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

    /**
     * @var SuxxFormPopulate
     */
    private $populate;

    public function __construct(SuxxSession $session, SuxxProductTableDataGateway $productDataGateway, SuxxFormPopulate $formPopulate)
    {
        $this->productDataGateway = $productDataGateway;
        $this->session = $session;
        $this->populate = $formPopulate;
    }

    public function execute(SuxxRequest $request, SuxxResponse $response)
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
