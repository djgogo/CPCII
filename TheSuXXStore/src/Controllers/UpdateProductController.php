<?php

class SuxxUpdateProductController implements SuxxController
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
        $updateproductFormCommand = new SuxxUpdateProductFormCommand($this->productDataGateway, $request, $response, $session);
        $updateproductFormCommand->validateRequest();

        if ($updateproductFormCommand->hasErrors()) {
            $updateproductFormCommand->repopulateForm();
            return 'updateproductview.twig';
        } else {
            $updateproductFormCommand->performAction();
        }

        $response->products = $this->productDataGateway->getAllProducts();
        return 'base.twig';
    }
}
