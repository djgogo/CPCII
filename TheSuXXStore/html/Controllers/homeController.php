<?php

class SuxxHomeController extends SuxxController
{
    public function execute(SuxxRequest $request, SuxxResponse $response)
    {
        $response->products = $this->dataGateway->getAllProducts();
        return new SuxxStaticView(__DIR__ . '/../Pages/homepage.xhtml');
    }
}
