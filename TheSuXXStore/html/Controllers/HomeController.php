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
    public function execute(SuxxRequest $request, SuxxResponse $response)
    {
        $response->products = $this->dataGateway->getAllProducts();
        return new SuxxStaticView(__DIR__ . '/../Pages/homepage.xhtml');
    }
}
