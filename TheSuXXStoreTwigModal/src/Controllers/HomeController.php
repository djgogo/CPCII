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
        $response->products = $this->dataGateway->getAllProducts();
        //var_dump($response); exit;
        return 'base.twig';
    }
}
