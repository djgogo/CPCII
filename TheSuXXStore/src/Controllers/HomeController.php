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
        unset($session->getSessionData()['error']);
        unset($session->getSessionData()['message']);

        var_dump($_SESSION);
        var_dump($session->getSessionData());
        var_dump($session->getValue('user'));

        $response->products = $this->dataGateway->getAllProducts();
        return new SuxxStaticView(__DIR__ . '/../../Pages/homepage.xhtml');
    }
}
