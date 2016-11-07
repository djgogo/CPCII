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
        $updateProductFormError = [
            'label' => '',
            'price' => ''
        ];
        $updateProductFormCommand = new SuxxUpdateProductFormCommand($this->productDataGateway, $request, $response, $session, $updateProductFormError);
        $updateProductFormCommand->validateRequest();

        if ($updateProductFormCommand->hasErrors()) {
            $response->setProducts($this->productDataGateway->findProductById($request->getValue('product-id')));
            $updateProductFormCommand->repopulateForm();
            return 'updateproductview.twig';
        } else {
            $updateProductFormCommand->performAction();
        }

        $response->setProducts($this->productDataGateway->getAllProducts());
        return 'base.twig';
    }
}
