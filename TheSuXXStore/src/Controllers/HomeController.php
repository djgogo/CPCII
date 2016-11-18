<?php

class SuxxHomeController implements SuxxController
{
    /**
     * @var SuxxSession
     */
    private $session;

    /**
     * @var SuxxProductTableDataGateway
     */
    private $dataGateway;

    public function __construct(SuxxSession $session, SuxxProductTableDataGateway $dataGateway)
    {
        $this->session = $session;
        $this->dataGateway = $dataGateway;
    }
    public function execute(SuxxRequest $request, SuxxResponse $response)
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
