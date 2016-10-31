<?php

class SuxxProductController implements SuxxController
{
    /**
     * @var SuxxCommentTableDataGateway
     */
    private $commentDataGateway;

    /**
     * @var SuxxProductTableDataGateway
     */
    private $productDataGateway;

    public function __construct(SuxxProductTableDataGateway $productDataGateway, SuxxCommentTableDataGateway $commentDataGateway)
    {
        $this->commentDataGateway = $commentDataGateway;
        $this->productDataGateway = $productDataGateway;
    }

    public function execute(SuxxRequest $request, SuxxSession $session, SuxxResponse $response)
    {
        if ($request->getValue('pid') === '') {
            return '404errorview.twig';
        }
        $response->product = $this->productDataGateway->findProductById($request->getValue('pid'));
        $response->comments = $this->commentDataGateway->findCommentsByPid($request->getValue('pid'));

        //TODO --> did it via base.twig!!!! change it to product.twig -> home.twig korrigieren ohne pagedetail flag!!!!
        return 'base.twig';
    }

}
