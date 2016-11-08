<?php

class SuxxUpdateProductController implements SuxxController
{
    /**
     * @var SuxxProductTableDataGateway
     */
    private $productDataGateway;

    /**
     * @var SuxxUpdateProductFormCommand
     */
    private $updateProductFormCommand;

    public function __construct(SuxxUpdateProductFormCommand $updateProductFormCommand, SuxxProductTableDataGateway $productDataGateway)
    {
        $this->productDataGateway = $productDataGateway;
        $this->updateProductFormCommand = $updateProductFormCommand;
    }

    public function execute(SuxxRequest $request, SuxxResponse $response)
    {
        $result = $this->updateProductFormCommand->execute($request);

        if ($result === false) {
            $response->setProduct($this->productDataGateway->findProductById($request->getValue('product-id')));
            $this->updateProductFormCommand->repopulateForm();
            return 'updateproductview.twig';
        }

        $response->setProducts($this->productDataGateway->getAllProducts());
        return 'base.twig';
    }
}
