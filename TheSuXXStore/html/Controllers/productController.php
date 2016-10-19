<?php

class SuxxProductController extends SuxxController
{

    public function execute(SuxxRequest $request, SuxxResponse $response)
    {
        $response->product = $this->dataGateway->findProductById($request->getValue('pid'));

        





//        $res = $db->query(
//            'select * from comments where PID="%s"',
//            $request->getValue('pid')
//        );
//        $response->comments = $res->getAll();

        return new SuxxStaticView(__DIR__ . '/../Pages/product.xhtml');
    }

}
