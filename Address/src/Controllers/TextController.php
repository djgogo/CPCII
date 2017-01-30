<?php

namespace Address\Controllers
{

    use Address\Gateways\TextTableDataGateway;
    use Address\Http\Request;
    use Address\Http\Response;
    use Address\Http\Session;

    class TextController implements ControllerInterface
    {
        /** @var Session */
        private $session;

        /** @var TextTableDataGateway */
        private $dataGateway;

        public function __construct(Session $session, TextTableDataGateway $dataGateway)
        {
            $this->session = $session;
            $this->dataGateway = $dataGateway;
        }

        public function execute(Request $request, Response $response)
        {
            if ($request->hasValue('sort')) {
                if ($request->getValue('sort') === 'ASC') {
                    $response->setTexts($this->dataGateway->getAllTextsOrderedByUpdatedAscending());
                    $this->session->setValue('sort', 'ASC');
                } elseif ($request->getValue('sort') === 'DESC') {
                    $response->setTexts($this->dataGateway->getAllTextsOrderedByUpdatedDescending());
                    $this->session->setValue('sort', 'DESC');
                }
            } else {
                $response->setTexts($this->dataGateway->getAllTexts());
                $this->session->setValue('sort', '');
            }

            if ($request->hasValue('searchText')) {
                $response->setTexts($this->dataGateway->getSearchedText($request->getValue('searchText')));
            }

            return 'text.twig';
        }
    }
}
