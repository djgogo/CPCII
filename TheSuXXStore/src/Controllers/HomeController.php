<?php

class SuxxHomeController implements SuxxController
{
    /**
     * @var SuxxProductTableDataGateway
     */
    private $dataGateway;

    public function __construct(SuxxProductTableDataGateway $dataGateway)
    {
        $this->dataGateway = $dataGateway;
    }
    public function execute(SuxxRequest $request, SuxxSession $session, SuxxResponse $response)
    {
        switch ($request->getValue('sort')) {
            case 'ASC':
                $response->products = $this->dataGateway->getAllProductsOrderedByUpdatedAscending();
                $session->setValue('sort', 'ASC');
                break;
            case 'DESC':
                $response->products = $this->dataGateway->getAllProductsOrderedByUpdatedDescending();
                $session->setValue('sort', 'DESC');
                break;
            default:
                $response->products = $this->dataGateway->getAllProducts();
                $session->setValue('sort', '');
        }

        if ($request->getValue('search')) {
            $response->products = $this->dataGateway->getSearchedProduct($request->getValue('search'));
        }

        return 'base.twig';
    }
}
